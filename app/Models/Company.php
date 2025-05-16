<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Company extends Model
{


    protected $fillable = [
        'company_name',
        'cnpj',
    ];
    public function entity(): MorphOne
    {
        return $this->morphOne(Entity::class, 'entityable');
    }
    public function getMorphClass()
    {
        return 'Company';
    }
}
