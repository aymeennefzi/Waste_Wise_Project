<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
        'community_id',
        'title',
        'description',
        'due_date',
        'status',
    ];
    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
=======
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

>>>>>>> 8b3de3b7daf35623eeedd959dfe5676281983156
}
