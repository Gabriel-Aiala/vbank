<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Entity extends Model
{
    protected $fillable = ['entityable_type', 'entityable_id'];

    // Relação 1:1 polimórfica (Entity pode ser Person ou Company)
    public function entityable(): MorphTo
    {
        return $this->morphTo();
    }

    // Relação com Credential (1:1)
    public function credential()
    {
        return $this->hasOne(Credential::class);
    }
}
