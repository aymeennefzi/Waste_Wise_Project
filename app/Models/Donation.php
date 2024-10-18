<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DonationStatus;


class Donation extends Model
{
    use HasFactory;
      protected $fillable = [
        'userId',
        'amount',
        'donorName' ,
        'cause',
        'status',
        'campaign_id'
    ];
    protected $casts = [
        'status' => DonationStatus::class,
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userId'); 
    }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
