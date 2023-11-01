<?php

namespace TechArena\Funcionalities\Preferences\Infra\Interfaces;
use TechArena\Funcionalities\Preferences\Infra\Model\Preferences;

interface PreferencesInterface
{
    public function select_specific(string $desc_preference): Preferences;
    public function select(): array;
    public function create(Preferences $preferences);
    public function update(Preferences $preferences);
    public function delete(Preferences $preferences);

}