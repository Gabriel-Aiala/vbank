<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credential extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    protected $table = 'credentials'; // Corrigido
    protected $fillable = ['entity_id', 'email', 'password'];
    protected $hidden = ['password']; // Removido remember_token

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    // JWT Methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        $this->loadMissing('entity.entityable'); // Carrega o relacionamento

        return [
            'entity_id' => $this->entity_id,
            'user_type' => class_basename($this->entity->entityable)
        ];
    }
}
