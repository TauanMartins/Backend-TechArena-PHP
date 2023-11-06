<?php

namespace TechArena\Provider;

use Illuminate\Support\ServiceProvider as Base;

use TechArena\Funcionalities\Permissions\Infra\Interfaces\PermissionsInterface;
use TechArena\Funcionalities\Permissions\Infra\Repository\Database\PermissionRepository as PermissionRepositoryConcretely;

use TechArena\Funcionalities\Preferences\Infra\Interfaces\PreferencesInterface;
use TechArena\Funcionalities\Preferences\Infra\Repository\Database\PreferencesRepository as PreferenceRepositoryConcretely;

use TechArena\Funcionalities\UserPreferences\Infra\Interfaces\UserPreferencesInterface;
use TechArena\Funcionalities\UserPreferences\Infra\Repository\Database\UserPreferencesRepository as UserPreferencesRepositoryConcretely;

use TechArena\Funcionalities\UserPreferences\Infra\Interfaces\UserPreferencePreferedThemeInterface;
use TechArena\Funcionalities\UserPreferences\Infra\Repository\Database\UserPreferencePreferedThemeRepository as UserPreferencePreferedThemeRepositoryConcretely;

use TechArena\Funcionalities\Users\Infra\Interfaces\UsersInterface;
use TechArena\Funcionalities\Users\Infra\Repository\Database\UsersRepository as UsersRepositoryConcretely;

/**
 * bind a deps with laravel service provider
 */
class ServiceProvider extends Base
{
    public $bindings = [
        PermissionsInterface::class => PermissionRepositoryConcretely::class,
        PreferencesInterface::class => PreferenceRepositoryConcretely::class,
        UserPreferencesInterface::class => UserPreferencesRepositoryConcretely::class,
        UserPreferencePreferedThemeInterface::class => UserPreferencePreferedThemeRepositoryConcretely::class,
        UsersInterface::class => UsersRepositoryConcretely::class
    ];
}