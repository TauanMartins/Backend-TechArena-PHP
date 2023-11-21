<?php

namespace TechArena\Funcionalities\UserChat;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat as UserChatModel;
use TechArena\Funcionalities\User\Infra\Model\User;
use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface;
use TechArena\Funcionalities\UserTeam\Infra\Interfaces\UserTeamInterface;
use TechArena\Funcionalities\UserTeam\Infra\Model\UserTeam;

class UserTeamChat
{
    private UserTeamInterface $repositoryUser;
    private UserChatInterface $repositoryUserChat;
    public function __construct(
        UserChatInterface $repositoryUserChat,
        UserTeamInterface $repositoryUser
    ) {
        $this->repositoryUserChat = $repositoryUserChat;
        $this->repositoryUser = $repositoryUser;
    }
    public function domain(UserChatModel $userChat, Team $team, User $user)
    {
        // verificar se o cara é permitido
        // verificar se existe o user_chat ligando o cara para aquele chat_id do time
        // se sim, retornar o chat_id
        // se não, criar o user_chat do cara para aquele chat_id do time
        $allowed = $this->repositoryUser->allowedUserInTeam(new UserTeam($user->getId(), $team->getId(), true, true));

        try {
            DB::beginTransaction();
            if ($allowed) {
                $exists = $this->repositoryUserChat->exist($userChat);
                if (!$exists) {
                    $this->repositoryUserChat->create($userChat);
                }
            } else {
                throw new Exception("Usuário não permitido para este chat de time.");
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

    }
}