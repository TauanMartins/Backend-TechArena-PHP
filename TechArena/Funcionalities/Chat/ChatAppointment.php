<?php

namespace TechArena\Funcionalities\Chat;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Appointment\Infra\Model\Appointment;
use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\User\Infra\Model\User;
use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface;
use TechArena\Funcionalities\UserAppointment\Infra\Model\UserAppointment;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat as UserChatModel;
use TechArena\Funcionalities\UserChat\UserAppointmentChat;
use TechArena\Funcionalities\UserChat\UserTeamChat;

class ChatAppointment
{
    private ChatInterface $repositoryChat;
    private UserAppointmentChat $repositoryUserChat;
    public function __construct(
        ChatInterface $repositoryChat,
        UserAppointmentChat $repositoryUserChat
    ) {
        $this->repositoryChat = $repositoryChat;
        $this->repositoryUserChat = $repositoryUserChat;
    }
    public function domain(User $user, Appointment $appointment)
    {
        $chatExist = $this->repositoryChat->existAppointmentChat($appointment);

        try {
            DB::beginTransaction();
            if ($chatExist) {
                $chatId = $appointment->getChatId();
                $userChat = new UserChatModel($chatId, $user->getId());
                $userAppointment = new UserAppointment($appointment->getId(), $user->getId(), false);
                $this->repositoryUserChat->domain($userChat, $userAppointment);
            } else { 
                throw new Exception("Chat não encontrado.");
            }
            DB::commit();
            return $chatId;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}