<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'task_type',
        'description',
        'start_time',
        'end_time',
        'estimated_duration',
        'cost_estimate'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
