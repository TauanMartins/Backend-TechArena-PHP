<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Appointment\Infra\Model\Appointment;
use TechArena\Funcionalities\Appointment\Appointments;
use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class AppointmentsCreateController extends Controller
{
    private UserInterface $user;
    private Appointments $appointment;
    private ArenaInterface $arena;
    public function __construct(Appointments $appointment, UserInterface $user, ArenaInterface $arena)
    {
        $this->appointment = $appointment;
        $this->user = $user;
        $this->arena = $arena;
    }
    public function __invoke(Request $request)
    {
        try {
            $user = $this->user->selectByUsername($request['username']);
            $sport_arena = $this->arena->selectSpecificBySport($request['sport_id'], $request['arena_id']);
            $appointment = new Appointment(DateTime::createFromFormat('Y-m-d', $request['date']), $sport_arena, $request['schedule_id'], $user->getId());
            $this->appointment->domain($appointment);
            return response()->json([], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
