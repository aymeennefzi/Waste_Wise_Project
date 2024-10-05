<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'creatorId'];

    public function memberships()
    {
        return $this->hasMany(Membership::class, 'communityId');
    }
}

