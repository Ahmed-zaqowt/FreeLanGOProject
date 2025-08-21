<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, HasUlids;
    
    protected $guarded = [];

    public function localPhoneLength(): int
    {
        $lengths = [
            'SA' => 9,
            'EG' => 10,
            'AE' => 9,
            'US' => 10,
            'FR' => 9,
            'DE' => 10,
            'GB' => 10,
            'CN' => 11,
            'JP' => 10,
            'IN' => 10,
        ];

        return $lengths[$this->code] ?? 10;
    }
}
