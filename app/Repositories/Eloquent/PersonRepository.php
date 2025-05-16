<?php

namespace App\Repositories\Eloquent;

use App\Models\Person;
use App\Repositories\Interfaces\PersonRepositoryInterface;

class PersonRepository implements PersonRepositoryInterface
{
    public function create(array $data): Person
    {
        return Person::create($data);
    }
}
