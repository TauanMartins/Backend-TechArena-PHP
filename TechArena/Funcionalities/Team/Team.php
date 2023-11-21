<?php

namespace TechArena\Funcionalities\Team;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface;
use TechArena\Funcionalities\Team\Infra\Interfaces\TeamInterface;
use TechArena\Funcionalities\Team\Infra\Model\Team as TeamModel;
use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;
use TechArena\Funcionalities\User\Infra\Model\User as UserModel;
use TechArena\Funcionalities\UserTeam\Infra\Interfaces\UserTeamInterface;
use TechArena\Funcionalities\UserTeam\Infra\Model\UserTeam;

class Team
{
    private ChatInterface $chat;
    private TeamInterface $team;
    private UserInterface $user;
    private UserTeamInterface $userTeam;
    private UserChatInterface $userChat;
    public function __construct(ChatInterface $chat, TeamInterface $team, UserInterface $user, UserTeamInterface $userTeam, UserChatInterface $userChat)
    {
        $this->chat = $chat;
        $this->team = $team;
        $this->user = $user;
        $this->userTeam = $userTeam;
        $this->userChat = $userChat;
    }
    public function domain(UserModel $userModel, TeamModel $teamModel)
    {
        // etapas:
        // 1. criar chat do time
        // 2. criar time.
        // 3. inserir usuário no time.
        // 4. inserir usuário no chat do time

        try {
            DB::beginTransaction();
            $chat = $this->chat->create(true);
            $teamModel->setChatId($chat->getId());
            $this->team->create($teamModel);
            $this->userTeam->insertUserInTeam(new UserTeam($userModel->getId(), $teamModel->getId(), true, true), true);
            $this->userChat->create(new UserChat($chat->getId(), $userModel->getId()));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

    }
    public function accept_member(UserTeam $userModel, TeamModel $teamModel)
    {
        try {
            DB::beginTransaction();
            $this->userTeam->acceptUserInTeam(new UserTeam($userModel->getUserId(), $teamModel->getId(), true, true));
            $this->userChat->create(new UserChat($teamModel->getChatId(), $userModel->getUserId()));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

    }
    public function request_member(UserTeam $userModel, TeamModel $teamModel)
    {
        try {
            DB::beginTransaction();
            $this->userTeam->insertUserInTeam(new UserTeam($userModel->getUserId(), $teamModel->getId(), false, true), false);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

    }

}