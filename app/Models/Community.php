<?php
// app/Models/Community.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image_url'];

    public function memberships()
    {
        return $this->hasMany(Membership::class, 'communityId');
    }

    public function tasksc()
    {
        return $this->hasMany(TaskC::class);
    }
}
