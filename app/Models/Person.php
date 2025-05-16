<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Person extends Model
{


    protected $fillable = [
        'name',
        'cpf',
        'birth_date',

    ];
    public function entity(): MorphOne
    {
        return $this->morphOne(Entity::class, 'entityable');
    }
    public function getMorphClass()
    {
        return 'Person'; // Valor customizado
    }
}
