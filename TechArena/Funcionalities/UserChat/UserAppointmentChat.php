<?php

namespace TechArena\Funcionalities\UserChat;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;
use TechArena\Funcionalities\UserAppointment\Infra\Interfaces\UserAppointmentInterface;
use TechArena\Funcionalities\UserAppointment\Infra\Model\UserAppointment;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat as UserChatModel;
use TechArena\Funcionalities\User\Infra\Model\User;
use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface;
use TechArena\Funcionalities\UserTeam\Infra\Interfaces\UserTeamInterface;
use TechArena\Funcionalities\UserTeam\Infra\Model\UserTeam;

class UserAppointmentChat
{
    private UserAppointmentInterface $repositoryUser;
    private UserChatInterface $repositoryUserChat;
    public function __construct(
        UserChatInterface $repositoryUserChat,
        UserAppointmentInterface $repositoryUser
    ) {
        $this->repositoryUserChat = $repositoryUserChat;
        $this->repositoryUser = $repositoryUser;
    }
    public function domain(UserChatModel $userChat, UserAppointment $userAppointment)
    {
        $allowed = $this->repositoryUser->allowedUserInAppointment($userAppointment);
        // se sim, retornar o chat_id
        // se não, criar o user_chat do cara para aquele chat_id do time

        try {
            if ($allowed) {
                $exists = $this->repositoryUserChat->exist($userChat);
                if (!$exists) {
                    $this->repositoryUserChat->create($userChat);
                }
            } else {
                throw new Exception('Usuário não permitido.');
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }
}