<?php

namespace TechArena\Funcionalities\Chat;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Team\Infra\Model\Team;
use TechArena\Funcionalities\User\Infra\Model\User;
use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat as UserChatModel;
use TechArena\Funcionalities\UserChat\UserTeamChat;

class ChatTeam
{
    private ChatInterface $repositoryChat;
    private UserTeamChat $repositoryUserChat;
    public function __construct(
        ChatInterface $repositoryChat,
        UserTeamChat $repositoryUserChat
    ) {
        $this->repositoryChat = $repositoryChat;
        $this->repositoryUserChat = $repositoryUserChat;
    }
    public function domain(User $user, Team $team)
    {
        $chatExist = $this->repositoryChat->existTeamChat($team);
        
        try {
            DB::beginTransaction();
            if ($chatExist) {
                $chatId = $team->getChatId();
                $userChat = new UserChatModel($chatId, $user->getId());
                $this->repositoryUserChat->domain($userChat, $team, $user);
            }else{
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