<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collecte extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'chauffeur_id',
        'centre_collecte_id',
        'date_heure',
    ];

    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class);
    }

    public function centreCollecte()
    {
        return $this->belongsTo(CentreCollecte::class);
    }
}
