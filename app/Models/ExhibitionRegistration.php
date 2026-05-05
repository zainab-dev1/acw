<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitionRegistration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function files()
    {
        return $this->hasMany(ExhibitionRegistrationFile::class, 'registration_id');
    }
}
