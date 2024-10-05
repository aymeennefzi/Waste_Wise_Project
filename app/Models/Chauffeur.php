<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chauffeur extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'image', 'telephone', 'matricule'];
    public function collectes()
    {
        return $this->hasMany(Collecte::class);
    }
}
