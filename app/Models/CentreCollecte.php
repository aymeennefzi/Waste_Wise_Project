<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentreCollecte extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'adresse', 'capacite'];
    public function collectes()
    {
        return $this->hasMany(Collecte::class);
    }
}
