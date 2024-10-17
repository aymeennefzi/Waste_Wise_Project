<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'buyer_id',
        'meeting_time',
        'status',
        'item_post_id'
    ];

    // Define the relationship with the User model
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function itemPost()
    {
        return $this->belongsTo(ItemPost::class, 'item_post_id');
    }
}
