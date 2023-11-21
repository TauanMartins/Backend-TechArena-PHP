<?php

namespace TechArena\Funcionalities\AWS\Interfaces;

interface AWSInterface
{
    public function getImage(string $folder, string $name);
    public function insertImage(string $folder, string $name, $imageData): string|null;
    public function editImage(string $folder, string|null $oldName, string $newName, $imageData): string|null;
}
