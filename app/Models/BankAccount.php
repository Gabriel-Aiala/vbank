<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = ["branch", "account_number", "balance", "entity_id"];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
