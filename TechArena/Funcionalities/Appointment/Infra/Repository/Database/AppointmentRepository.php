<?php

namespace TechArena\Funcionalities\Appointment\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Appointment\Infra\Interfaces\AppointmentInterface as Base;
use TechArena\Funcionalities\Appointment\Infra\Model\Appointment;
use TechArena\Funcionalities\User\Infra\Model\User;

class AppointmentRepository implements Base
{

    public function select(User $user, string $lat, string $longitude, $cursor): array
    {
        try {
            $earthRadius = 6371; // Raio da Terra em quilômetros

            $userId = $user->getId();
            $currentDateTime = new DateTime();
            $currentDateTime = $currentDateTime->format('Y-m-d H:i:s');
            // Obter esportes preferidos
            $preferedSports = DB::table('prefered_sports', 'ps')
                ->select('s.id')
                ->join('sport as s', 'ps.sport_id', '=', 's.id')
                ->where('ps.user_id', '=', $userId)
                ->pluck('s.id')
                ->toArray();

            // Gerar uma string SQL para a pontuação de preferência se houver esportes preferidos
            $preferenceScore = "";
            if (!empty($preferedSports)) {
                $preferenceScore = ", CASE s.id ";
                foreach ($preferedSports as $index => $sportId) {
                    $preferenceScore .= "WHEN $sportId THEN " . (count($preferedSports) - $index) . " ";
                }
                $preferenceScore .= "ELSE 0 END AS preferenceScore";
            }

            $appointments = DB::table('appointment as ap')
                ->select(DB::raw("                
                ap.id,
                u.username,
                ar.image,
                ar.address,
                ap.date,
                s.id as sport_id,
                s.name,
                sc.horary,
                ROUND(($earthRadius * ACOS(COS(RADIANS($lat)) * COS(RADIANS(ar.lat)) * COS(RADIANS(ar.longitude) - RADIANS($longitude)) + SIN(RADIANS($lat)) * SIN(RADIANS(ar.lat)))) * 10) / 10 AS distance,
                (
                    SELECT COUNT(*) 
                    FROM user_appointment
                    WHERE appointment_id = ap.id
                ) AS players,
                EXISTS (
                    SELECT 1
                    FROM user_appointment AS ua
                    WHERE ua.appointment_id = ap.id AND ua.user_id = $userId
                ) AS is_inside
                $preferenceScore
            "))
                ->join('sport_arena as sa', 'ap.sport_arena_id', '=', 'sa.id')
                ->join('sport as s', 'sa.sport_id', '=', 's.id')
                ->join('arena as ar', 'ar.id', '=', 'sa.arena_id')
                ->join('schedule as sc', 'sc.id', '=', 'ap.schedule_id')
                ->join('user as u', 'u.id', '=', 'ap.organizer_id')
                ->whereRaw("CONCAT(ap.date, ' ', sc.horary)::timestamp > ?", [$currentDateTime]);

            // Ordenar baseado na existência de esportes preferidos
            if (!empty($preferedSports)) {
                $appointments = $appointments->orderByRaw('preferenceScore DESC, distance ASC, date ASC');
            } else {
                $appointments = $appointments->orderBy('distance', 'asc')->orderBy('date', 'asc');
            }

            return $appointments->cursorPaginate(10, ['*'], 'cursor', $cursor)->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAll(User $user, string $lat, string $longitude, $cursor): array
    {
        try {

            $userId = $user->getId();
            $currentDateTime = new DateTime();
            $currentDateTime = $currentDateTime->format('Y-m-d H:i:s');
            $earthRadius = 6371; // Raio da Terra em quilômetros
            $appointments = DB::table('appointment as ap')
                ->select(DB::raw("
                ap.id,
                u.username,
                ar.image,
                ar.address,
                ap.date,
                s.id as sport_id,
                s.name,
                sc.horary,
                ROUND(($earthRadius * ACOS(COS(RADIANS($lat)) * COS(RADIANS(ar.lat)) * COS(RADIANS(ar.longitude) - RADIANS($longitude)) + SIN(RADIANS($lat)) * SIN(RADIANS(ar.lat)))) * 10) / 10 AS distance,
                (
                    SELECT COUNT(*) 
                    FROM user_appointment
                    WHERE appointment_id = ap.id
                ) AS players,
                EXISTS (
                    SELECT 1
                    FROM user_appointment AS ua
                    WHERE ua.appointment_id = ap.id AND ua.user_id = $userId
                ) AS is_inside
                "))
                ->join('sport_arena as sa', 'ap.sport_arena_id', '=', 'sa.id')
                ->join('sport as s', 'sa.sport_id', '=', 's.id')
                ->join('arena as ar', 'ar.id', '=', 'sa.arena_id')
                ->join('schedule as sc', 'sc.id', '=', 'ap.schedule_id')
                ->join('user as u', 'u.id', '=', 'ap.organizer_id')
                ->whereRaw("CONCAT(ap.date, ' ', sc.horary)::timestamp > ?", [$currentDateTime])
                ->orderBy('distance', 'asc')
                ->orderBy('date', 'asc')
                ->cursorPaginate(10, ['*'], 'cursor', $cursor)
                ->toArray();

            return $appointments;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectById(int $id): Appointment
    {
        try {
            $appointmentDB = DB::table('appointment')->where('id', '=', $id)->first();

            $appointment = new Appointment(DateTime::createFromFormat('Y-m-d', $appointmentDB->date), $appointmentDB->sport_arena_id, $appointmentDB->schedule_id, $appointmentDB->organizer_id);
            $appointment->setChatId($appointmentDB->chat_id);
            $appointment->setId($id);
            return $appointment;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(Appointment $appointment): void
    {
        try {
            $id = DB::table('appointment')->insertGetId($appointment->toArray());
            $appointment->setId($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}