<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    // Combinez les champs des deux branches dans $fillable
    protected $fillable = ['name', 'description', 'image_url'];

    // Gardez la relation memberships() de la branche master
    public function memberships()
    {
        return $this->hasMany(Membership::class, 'communityId');
    }

    // Gardez aussi la relation tasks() de la branche khouloud
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
