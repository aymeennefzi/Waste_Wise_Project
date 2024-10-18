<?php

namespace App\Enums;

enum DonationStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled'; 

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::CONFIRMED => 'Confirmed',
            self::FAILED => 'Failed',
            self::CANCELLED => 'Cancelled',
        };
    }
}