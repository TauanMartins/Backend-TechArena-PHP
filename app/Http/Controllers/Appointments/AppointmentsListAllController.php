<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Appointment\Infra\Interfaces\AppointmentInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class AppointmentsListAllController extends Controller
{
    private UserInterface $user;
    private AppointmentInterface $appointment;
    public function __construct(AppointmentInterface $appointment, UserInterface $user)
    {
        $this->appointment = $appointment;
        $this->user = $user;
    }
    public function __invoke(Request $request)
    {

        $cursor = $request->input('cursor', null);
        try {
            $lat = $request['lat'];
            $longitude = $request['longitude'];
            $user = $this->user->selectByUsername($request['username']);
            if ($request['filter']) {
                $appointments = $this->appointment->select($user, $lat, $longitude, $cursor);
            } else {
                $appointments = $this->appointment->selectAll($user, $lat, $longitude, $cursor);
            }
            return response()->json($appointments, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
