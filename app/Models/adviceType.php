<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adviceType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'created_at'];
    public function wasteTips()
    {
        return $this->hasMany(WasteTip::class);
    }
}
