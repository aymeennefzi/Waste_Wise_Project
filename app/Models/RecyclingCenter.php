<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecyclingCenter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'latitude', 'longitude', 'opening_hours', 'contact_info', 'website_url','image',];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
