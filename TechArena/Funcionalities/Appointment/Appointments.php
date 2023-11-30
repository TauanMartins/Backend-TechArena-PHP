<?php

namespace TechArena\Funcionalities\Appointment;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Appointment\Infra\Interfaces\AppointmentInterface;
use TechArena\Funcionalities\Appointment\Infra\Model\Appointment;
use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface;
use TechArena\Funcionalities\UserAppointment\Infra\Interfaces\UserAppointmentInterface;
use TechArena\Funcionalities\UserAppointment\Infra\Model\UserAppointment;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;
use TechArena\Funcionalities\UserChat\UserAppointmentChat;

class Appointments
{
    private AppointmentInterface $appointmentInterface;
    private ChatInterface $chatInterface;
    private UserAppointmentChat $userAppointmentChat;
    private UserAppointmentInterface $userAppointment;
    public function __construct(
        AppointmentInterface $appointmentInterface,
        ChatInterface $chatInterface,
        UserAppointmentChat $userAppointmentChat,
        UserAppointmentInterface $userAppointment
    ) {
        $this->appointmentInterface = $appointmentInterface;
        $this->chatInterface = $chatInterface;
        $this->userAppointmentChat = $userAppointmentChat;
        $this->userAppointment = $userAppointment;
    }
    public function domain(Appointment $appointment, bool $holder)
    {

        try {
            DB::beginTransaction();
            $chat = $this->chatInterface->create(true);
            $appointment->setChatId($chat->getId());
            $this->appointmentInterface->create($appointment);
            $user_appointment = new UserAppointment($appointment->getId(), $appointment->getOrganizerId(), $holder);
            $this->userAppointment->create($user_appointment);
            $this->userAppointmentChat->domain(new UserChat($appointment->getChatId(), $appointment->getOrganizerId()), $user_appointment);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}