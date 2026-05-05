<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitionSetting extends Model
{
    use HasFactory;

    protected $table = 'exhibition_settings';

    protected $guarded = ['id'];

    protected $casts = [
        'is_open' => 'boolean',
    ];

    public static function current()
    {
        return static::query()->first();
    }
}
