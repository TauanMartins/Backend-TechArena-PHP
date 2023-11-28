<?php

namespace TechArena\Provider;

use Illuminate\Support\ServiceProvider as Base;

use TechArena\Funcionalities\SportArena\Infra\Interfaces\SportArenaInterface;
use TechArena\Funcionalities\SportArena\Infra\Repository\Database\SportArenaRepository as SportArenaRepositoryConcretely;

use TechArena\Funcionalities\UserAppointment\Infra\Interfaces\UserAppointmentInterface;
use TechArena\Funcionalities\UserAppointment\Infra\Repository\Database\UserAppointmentRepository as UserAppointmentRepositoryConcretely;

use TechArena\Funcionalities\Appointment\Infra\Interfaces\AppointmentInterface;
use TechArena\Funcionalities\Appointment\Infra\Repository\Database\AppointmentRepository as AppointmentRepositoryConcretely;

use TechArena\Funcionalities\SportPrefered\Infra\Interfaces\SportPreferedInterface;
use TechArena\Funcionalities\SportPrefered\Infra\Repository\Database\SportPreferedRepository as SportPreferedRepositoryConcretely;

use TechArena\Funcionalities\Sport\Infra\Interfaces\SportInterface;
use TechArena\Funcionalities\Sport\Infra\Repository\Database\SportRepository as SportRepositoryConcretely;

use TechArena\Funcionalities\AWS\Interfaces\AWSInterface;
use TechArena\Funcionalities\AWS\Repository\AWSRepository as AWSRepositoryConcretely;

use TechArena\Funcionalities\UserTeam\Infra\Interfaces\UserTeamInterface;
use TechArena\Funcionalities\UserTeam\Infra\Repository\Database\UserTeamRepository as UserTeamRepositoryConcretely;

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
        SportArenaInterface::class => SportArenaRepositoryConcretely::class,
        UserAppointmentInterface::class => UserAppointmentRepositoryConcretely::class,
        AppointmentInterface::class => AppointmentRepositoryConcretely::class,
        SportPreferedInterface::class => SportPreferedRepositoryConcretely::class,
        SportInterface::class => SportRepositoryConcretely::class,
        UserTeamInterface::class => UserTeamRepositoryConcretely::class,
        AWSInterface::class => AWSRepositoryConcretely::class,
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