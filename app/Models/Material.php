<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'material_name',
        'description',
        'recycling_center_id',
    ];

    public function recyclingCenter()
    {
        return $this->belongsTo(RecyclingCenter::class);
    }
}
