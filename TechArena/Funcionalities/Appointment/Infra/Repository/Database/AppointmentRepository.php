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

    public function select(User $user, string $lat, string $longitude, int $page, string $orderByTime, string $distance): array
    {
        try {
            $earthRadius = 6371; // Raio da Terra em quilômetros
            $userId = $user->getId();
            $currentDateTime = new DateTime();
            $currentDateTime = $currentDateTime->format('Y-m-d H:i:s');

            $preferedSports = DB::table('prefered_sports', 'ps')
                ->select('s.id')
                ->join('sport as s', 'ps.sport_id', '=', 's.id')
                ->where('ps.user_id', '=', $userId)
                ->pluck('s.id')
                ->toArray();

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
                ar.id as arena_id,
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

            if (!empty($preferedSports)) {
                $appointments = $appointments->orderByRaw('preferenceScore DESC');
            }

            $orderByDistance = $distance === 'near' ? 'asc' : 'desc';
            $appointments = $appointments->orderBy('distance', $orderByDistance);

            $orderByDate = $orderByTime === 'recent' ? 'asc' : 'desc';
            $appointments = $appointments->orderBy('ap.date', $orderByDate);

            $perPage = 10; // Definir o número de itens por página
            return $appointments->paginate($perPage, ['*'], 'page', $page)->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function selectUserAppointments(User $user, string $lat, string $longitude, int $page, string $orderByTime, string $distance): array
    {
        try {
            $earthRadius = 6371; // Raio da Terra em quilômetros
            $userId = $user->getId();
            $currentDateTime = new DateTime();
            $currentDateTime = $currentDateTime->format('Y-m-d H:i:s');

            $preferedSports = DB::table('prefered_sports', 'ps')
                ->select('s.id')
                ->join('sport as s', 'ps.sport_id', '=', 's.id')
                ->where('ps.user_id', '=', $userId)
                ->pluck('s.id')
                ->toArray();

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
                    ar.id as arena_id,
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
                ->join('user_appointment as ua', 'ua.appointment_id', '=', 'ap.id')
                ->where('ua.user_id', '=', $userId);

            if (!empty($preferedSports)) {
                $appointments = $appointments->orderByRaw('preferenceScore DESC');
            }

            $orderByDistance = $distance === 'near' ? 'asc' : 'desc';
            $appointments = $appointments->orderBy('distance', $orderByDistance);

            $orderByDate = $orderByTime === 'recent' ? 'asc' : 'desc';
            $appointments = $appointments->orderBy('ap.date', $orderByDate);

            $perPage = 10; // Definir o número de itens por página
            return $appointments->paginate($perPage, ['*'], 'page', $page)->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAll(User $user, string $lat, string $longitude, int $page, string $orderByTime, string $distance): array
    {
        try {
            $earthRadius = 6371; // Raio da Terra em quilômetros
            $userId = $user->getId();
            $currentDateTime = new DateTime();
            $currentDateTime = $currentDateTime->format('Y-m-d H:i:s');

            // Consulta principal
            $appointments = DB::table('appointment as ap')
                ->select(DB::raw("
                ap.id,
                u.username,
                ar.image,
                ar.address,
                ap.date,                
                ar.id as arena_id,
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
                ->whereRaw("CONCAT(ap.date, ' ', sc.horary)::timestamp > ?", [$currentDateTime]);

            // Ordenação por tempo
            $orderByDate = $orderByTime === 'recent' ? 'asc' : 'desc';
            $appointments = $appointments->orderBy('ap.date', $orderByDate);

            // Ordenação por distância
            $orderByDistance = $distance === 'near' ? 'asc' : 'desc';
            $appointments = $appointments->orderBy('distance', $orderByDistance);

            // Paginação
            $perPage = 10; // Número de itens por página
            return $appointments->paginate($perPage, ['*'], 'page', $page)->toArray();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAllUserAppointments(User $user, string $lat, string $longitude, int $page, string $orderByTime, string $distance): array
    {
        try {
            $earthRadius = 6371; // Raio da Terra em quilômetros
            $userId = $user->getId();
            $currentDateTime = new DateTime();
            $currentDateTime = $currentDateTime->format('Y-m-d H:i:s');

            $appointments = DB::table('appointment as ap')
                ->select(DB::raw("
                    ap.id,
                    u.username,
                    ar.image,
                    ar.address,
                    ap.date,
                    ar.id as arena_id,
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
                ->join('user_appointment as ua', 'ua.appointment_id', '=', 'ap.id')
                ->where('ua.user_id', '=', $userId);

            $orderByDistance = $distance === 'near' ? 'asc' : 'desc';
            $appointments = $appointments->orderBy('distance', $orderByDistance);

            $orderByDate = $orderByTime === 'recent' ? 'asc' : 'desc';
            $appointments = $appointments->orderBy('ap.date', $orderByDate);

            $perPage = 10; // Número de itens por página
            return $appointments->paginate($perPage, ['*'], 'page', $page)->toArray();
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