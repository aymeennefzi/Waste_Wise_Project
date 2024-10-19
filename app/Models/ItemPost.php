<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPost extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'description', 'image', 'lat', 'lng', 'user_id', 'status', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Use 'user_id' as the foreign key
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'item_post_id');
    }
}
