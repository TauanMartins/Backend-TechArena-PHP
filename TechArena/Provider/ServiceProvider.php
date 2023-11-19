<?php

namespace TechArena\Provider;

use Illuminate\Support\ServiceProvider as Base;

use TechArena\Funcionalities\Team\Infra\Interfaces\TeamInterface;
use TechArena\Funcionalities\Team\Infra\Repository\Database\TeamRepository as TeamRepositoryConcretely;

use TechArena\Funcionalities\Friend\Infra\Interfaces\FriendInterface;
use TechArena\Funcionalities\Friend\Infra\Repository\Database\FriendRepository as FriendRepositoryConcretely;

use TechArena\Funcionalities\Message\Infra\Interfaces\MessageInterface;
use TechArena\Funcionalities\Message\Infra\Repository\Database\MessageRepository as MessageRepositoryConcretely;

use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface;
use TechArena\Funcionalities\Chat\Infra\Repository\Database\ChatRepository as ChatRepositoryConcretely;

use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface;
use TechArena\Funcionalities\UserChat\Infra\Repository\Database\UserChatRepository as UserChatRepositoryConcretely;

use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface;
use TechArena\Funcionalities\Arena\Infra\Repository\Database\ArenaRepository as ArenaRepositoryConcretely;

use TechArena\Funcionalities\Permission\Infra\Interfaces\PermissionInterface;
use TechArena\Funcionalities\Permission\Infra\Repository\Database\PermissionRepository as PermissionRepositoryConcretely;

use TechArena\Funcionalities\Preference\Infra\Interfaces\PreferenceInterface;
use TechArena\Funcionalities\Preference\Infra\Repository\Database\PreferenceRepository as PreferenceRepositoryConcretely;

use TechArena\Funcionalities\UserPreference\Infra\Interfaces\UserPreferenceInterface;
use TechArena\Funcionalities\UserPreference\Infra\Repository\Database\UserPreferenceRepository as UserPreferenceRepositoryConcretely;

use TechArena\Funcionalities\UserPreference\Infra\Interfaces\UserPreferencePreferedThemeInterface;
use TechArena\Funcionalities\UserPreference\Infra\Repository\Database\UserPreferencePreferedThemeRepository as UserPreferencePreferedThemeRepositoryConcretely;

use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;
use TechArena\Funcionalities\User\Infra\Repository\Database\UserRepository as UserRepositoryConcretely;

/**
 * bind a deps with laravel service provider
 */
class ServiceProvider extends Base
{
    public $bindings = [
        TeamInterface::class => TeamRepositoryConcretely::class,
        FriendInterface::class => FriendRepositoryConcretely::class,
        MessageInterface::class => MessageRepositoryConcretely::class,
        UserChatInterface::class => UserChatRepositoryConcretely::class,
        ChatInterface::class => ChatRepositoryConcretely::class,
        ArenaInterface::class => ArenaRepositoryConcretely::class,
        PermissionInterface::class => PermissionRepositoryConcretely::class,
        PreferenceInterface::class => PreferenceRepositoryConcretely::class,
        UserPreferenceInterface::class => UserPreferenceRepositoryConcretely::class,
        UserPreferencePreferedThemeInterface::class => UserPreferencePreferedThemeRepositoryConcretely::class,
        UserInterface::class => UserRepositoryConcretely::class
    ];
}