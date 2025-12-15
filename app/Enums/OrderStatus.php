<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasLabel
{
    case Pending = 'pending';
    case Process = 'process';
    case Completed = 'completed';

    public function getLabel(): string
    {
        return match($this) {
            self::Pending => 'Pending',
            self::Process => 'Proses',
            self::Completed => 'Selesai',
        };
    }
}
