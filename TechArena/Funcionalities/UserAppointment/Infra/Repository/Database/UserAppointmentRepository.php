<?php

namespace TechArena\Funcionalities\UserAppointment\Infra\Repository\Database;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\UserAppointment\Infra\Interfaces\UserAppointmentInterface as Base;
use TechArena\Funcionalities\UserAppointment\Infra\Model\UserAppointment;

class UserAppointmentRepository implements Base
{

    public function select(): array
    {
        try {
            $appointments = DB::table('appointment as ap')
                ->select('ar.image', 'ar.lat', 'ar.longitude', 'ar.address', 'ap.date', 's.name', 'sc.horary')
                ->join('sport_arena as sa', 'ap.sport_arena_id', '=', 'sa.id')
                ->join('sport as s', 'sa.sport_id', '=', 's.id')
                ->join('arena as ar', 'ar.id', '=', 'sa.arena_id')
                ->join('schedule as sc', 'sc.id', '=', 'ap.schedule_id')
                ->get()
                ->toArray();
            return $appointments;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function selectAll(): array
    {
        try {
            $appointments = DB::table('appointment as ap')
                ->select('ar.image', 'ar.lat', 'ar.longitude', 'ar.address', 'ap.date', 's.name', 'sc.horary')
                ->join('sport_arena as sa', 'ap.sport_arena_id', '=', 'sa.id')
                ->join('sport as s', 'sa.sport_id', '=', 's.id')
                ->join('arena as ar', 'ar.id', '=', 'sa.arena_id')
                ->join('schedule as sc', 'sc.id', '=', 'ap.schedule_id')
                ->get()
                ->toArray();
            return $appointments;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(UserAppointment $userAppointment): void
    {
        try {
            DB::table('user_appointment')->insert($userAppointment->toArray());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function allowedUserInAppointment(UserAppointment $userAppointment): bool
    {
        try {
            $users = DB::table('appointment as a')
                ->join('user_appointment as ua', 'ua.appointment_id', '=', 'a.id')
                ->join('user as u', 'u.id', '=', 'ua.user_id')
                ->where('ua.user_id', '=', $userAppointment->getUserId())
                ->where('ua.appointment_id', '=', $userAppointment->getAppointmentId())
                ->exists();
            return $users;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}