<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Appointment\Infra\Interfaces\AppointmentInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;
use TechArena\Funcionalities\UserAppointment\Infra\Interfaces\UserAppointmentInterface;
use TechArena\Funcionalities\UserAppointment\Infra\Model\UserAppointment;
use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;

class UserAppointmentRequestController extends Controller
{
    private UserInterface $user;
    private AppointmentInterface $appointmentInterface;
    private UserChatInterface $userChatInterface;
    private UserAppointmentInterface $userAppointmentInterface;
    public function __construct(
        UserAppointmentInterface $userAppointmentInterface,
        AppointmentInterface $appointmentInterface,
        UserInterface $user,
        UserChatInterface $userChatInterface
    ) {
        $this->appointmentInterface = $appointmentInterface;
        $this->userAppointmentInterface = $userAppointmentInterface;
        $this->user = $user;
        $this->userChatInterface = $userChatInterface;
    }
    public function __invoke(Request $request)
    {
        try {
            $user = $this->user->selectByUsername($request['username']);
            $appointment = $this->appointmentInterface->selectById($request['appointment_id']);
            $holder = $request['holder'];
            $userAppointment = new UserAppointment($appointment->getId(), $user->getId(), $holder);
            $userChat = new UserChat($appointment->getChatId(), $user->getId());
            DB::beginTransaction();
            $this->userAppointmentInterface->create($userAppointment);
            $this->userChatInterface->create($userChat);
            DB::commit();
            return response()->json([], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
