<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteTip extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'author', 'Creation_date' , 'advice_type_id' , 'image'];
     public function adviceType()
     {
         return $this->belongsTo(adviceType::class);
     }

}
