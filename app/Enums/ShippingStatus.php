<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ShippingStatus: string implements HasLabel
{
    case Pending = 'pending';
    case Packed = 'packed';
    case Shipped = 'shipped';
    case Delivered = 'delivered';

    public function getLabel(): string
    {
        return match($this) {
            self::Pending => 'Pending',
            self::Packed => 'Dikemas',
            self::Shipped => 'Dikirim',
            self::Delivered => 'Terkirim',
        };
    }
}
