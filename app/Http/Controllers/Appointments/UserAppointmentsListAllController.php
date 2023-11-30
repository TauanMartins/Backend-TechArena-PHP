<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Appointment\Infra\Interfaces\AppointmentInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class UserAppointmentsListAllController extends Controller
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

        $page = $request->input('page', 1);
        $lat = $request->input('lat');
        $longitude = $request->input('longitude');
        $user = $this->user->selectByUsername($request->input('username'));
        $preferSports = $request->input('preferSports', false); // novo parâmetro
        $orderByTime = $request->input('orderByTime', 'recent'); // novo parâmetro: 'recent' ou 'future'
        $distance = $request->input('distance', 'near'); // novo parâmetro: 'recent' ou 'future'

        try {
            if ($preferSports) {
                $appointments = $this->appointment->selectUserAppointments($user, $lat, $longitude, $page, $orderByTime, $distance);
            } else {
                $appointments = $this->appointment->selectAllUserAppointments($user, $lat, $longitude, $page, $orderByTime, $distance);
            }
            return response()->json($appointments, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
