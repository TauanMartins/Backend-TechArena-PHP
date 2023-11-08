<?php

namespace TechArena\Funcionalities\Preference\Infra\Interfaces;
use TechArena\Funcionalities\Preference\Infra\Model\Preference;

interface PreferenceInterface
{
    public function select_specific(string $desc_preference): Preference;
    public function select(): array;
    public function create(Preference $preferences);
    public function update(Preference $preferences);
    public function delete(Preference $preferences);

}