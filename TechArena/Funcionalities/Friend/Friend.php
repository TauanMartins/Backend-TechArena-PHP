<?php

namespace TechArena\Funcionalities\Friend;

use Exception;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Friend\Infra\Interfaces\FriendInterface;
use TechArena\Funcionalities\Friend\Infra\Model\Friend as FriendModel;

class Friend
{
    private FriendInterface $friendInterface;
    public function __construct(
        FriendInterface $friendInterface
    ) {
        $this->friendInterface = $friendInterface;
    }
    public function domain(FriendModel $friendModel)
    {
        $friendshipExist = $this->friendInterface->exist($friendModel);
        if (!$friendshipExist) {
            $this->friendInterface->create($friendModel);
        }
    }
}