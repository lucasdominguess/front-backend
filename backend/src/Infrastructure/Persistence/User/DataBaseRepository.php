<?php 

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

interface DataBaseRepository 
{
    public function findAll($table): array;

    public function findUserOfId($table,$id);
}