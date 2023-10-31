<?php

namespace TechArena\Provider;

use Illuminate\Support\ServiceProvider as Base;

use TechArena\Funcionalities\Preferences\Infra\Interfaces\PreferencesInterface;
use TechArena\Funcionalities\Preferences\Infra\Repository\Database\PreferencesRepository as PreferenceRepositoryConcretely;

use TechArena\Funcionalities\Users\Infra\Interfaces\UsersInterface;
use TechArena\Funcionalities\Users\Infra\Repository\Database\UsersRepository as UsersRepositoryConcretely;

/**
 * bind a deps with laravel service provider
 */
class ServiceProvider extends Base
{
    public $bindings = [
        PreferencesInterface::class => PreferenceRepositoryConcretely::class,
        UsersInterface::class => UsersRepositoryConcretely::class
    ];
}