<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'eventName',
        'eventDate',
        'location',
        'descreption',
        'communityId',
        'createdAt',
        'updatedAt',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class); 
    }
}
