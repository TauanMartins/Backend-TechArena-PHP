<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Appointment\Infra\Interfaces\AppointmentInterface;
use TechArena\Funcionalities\Chat\ChatAppointment;
use TechArena\Funcionalities\Chat\ChatTeam;
use TechArena\Funcionalities\Team\Infra\Interfaces\TeamInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class ChatAppointmentCreateController extends Controller
{
    private ChatAppointment $chat;
    private AppointmentInterface $appointmentInterface;
    private UserInterface $user;
    public function __construct(ChatAppointment $chat, UserInterface $user, AppointmentInterface $appointmentInterface)
    {
        $this->chat = $chat;
        $this->appointmentInterface = $appointmentInterface;
        $this->user = $user;
    }
    public function __invoke(Request $request)
    {
        try {
            $user = $this->user->selectByUsername($request['username']);
            $appointment =  $this->appointmentInterface->selectById($request['appointment_id']);
            $chat_id = $this->chat->domain($user, $appointment);
            return response()->json(['chat_id' => $chat_id], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
