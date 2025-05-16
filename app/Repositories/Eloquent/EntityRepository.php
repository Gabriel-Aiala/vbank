<?php

namespace App\Repositories\Eloquent;

use App\Models\Entity;
use App\Repositories\Interfaces\EntityRepositoryInterface;

class EntityRepository implements EntityRepositoryInterface
{
    public function create(array $data): Entity
    {
        return Entity::create($data);
    }
}
