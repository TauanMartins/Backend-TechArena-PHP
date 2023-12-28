<?php

namespace TechArena\Funcionalities\UserTeam;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;
use TechArena\Funcionalities\UserTeam\Infra\Interfaces\UserTeamInterface;
use TechArena\Funcionalities\UserTeam\Infra\Model\UserTeam as UserTeamModel;

class UserTeam
{
    private UserTeamInterface $userTeamInterface;

    private UserChatInterface $userChat;
    public function __construct(
        UserTeamInterface $userTeamInterface,
        UserChatInterface $userChat
    ) {
        $this->userTeamInterface = $userTeamInterface;
        $this->userChat = $userChat;
    }
    public function domain(UserTeamModel $userTeamModel)
    {
        $exist = $this->userTeamInterface->exist($userTeamModel);
        try {
            if (!$exist) {
                $this->userTeamInterface->insertUserInTeam($userTeamModel, false);
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
    public function accepted(UserTeamModel $userTeamModel, Team $team)
    {
        $exist = $this->userTeamInterface->exist($userTeamModel);
        if (!$exist) {
            try {
                DB::beginTransaction();
                $this->userTeamInterface->acceptUserInTeam($userTeamModel);
                $this->userChat->create(new UserChat($team->getChatId(), $userTeamModel->getUserId()));
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
        }
    }
}