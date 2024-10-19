<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
