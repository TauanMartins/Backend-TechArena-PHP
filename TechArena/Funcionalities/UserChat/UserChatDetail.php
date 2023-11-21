<?php

namespace TechArena\Funcionalities\UserChat;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat as UserChatModel;
use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface;

class UserChatDetail
{
    private UserChatInterface $repositoryUserChat;
    public function __construct(
        UserChatInterface $repositoryUserChat
    ) {
        $this->repositoryUserChat = $repositoryUserChat;
    }
    public function domain(UserChatModel $userChat)
    {
        try {
            $allowed = $this->repositoryUserChat->allowed($userChat);
            if ($allowed) {
                $isTeamChat = $this->repositoryUserChat->isTeamChat($userChat);

                // 1. verificar se o usuário faz parte do chat
                // 2. verificar se o chat é de time 
                // 3. se sim : verificar se o usuário é dono do time 
                //             retornar ['isTeamChat'=> true]['isOwner'=> ?][usuários dentro do chat]
                // 4. se não : verificar se o usuário é dono do agendamento 
                // 5.           se não : verificar se o usuário é dono do agendamento 
                //             retornar ['created_at'=>]['isTeamChat'=> false]['isOwner'=> ?][usuários dentro do chat]

                if ($isTeamChat) {
                    $users = $this->repositoryUserChat->selectAllUsersInTeam($userChat);
                    $team = $this->repositoryUserChat->selectTeamId($userChat);
                    $teamDetail = $this->repositoryUserChat->selectChatDetail($userChat);
                    $usersSolicitationsRequests = [];
                    if ($team['isOwner']) {
                        $usersSolicitationsRequests = $this->repositoryUserChat->selectAllSolicitationsForTeam($userChat);
                    }
                    return [
                        'isTeamChat' => true,
                        'isOwner' => $team['isOwner'],
                        'users' => $users,
                        'teamId' => $team['teamId'],
                        'usersSolicitationsRequests' => $usersSolicitationsRequests,
                        'detail' => $teamDetail
                    ];
                } else {
                    $users = $this->repositoryUserChat->selectAllUsersInAppointment($userChat);
                    $appointmentDetail = $this->repositoryUserChat->selectAppointmentChatDetail($userChat);
                    return ['isTeamChat' => false, 'isOwner' => false, 'users' => $users, 'detail' => $appointmentDetail];
                }
            } else {
                throw new Exception('Usuário não permitido.');
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }


    }
}