<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitionRegistrationFile extends Model
{
    use HasFactory;

    protected $table = 'exhibition_registration_files';

    protected $guarded = ['id'];

    public function registration()
    {
        return $this->belongsTo(ExhibitionRegistration::class, 'registration_id');
    }
}
