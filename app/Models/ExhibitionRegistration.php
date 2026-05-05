<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitionRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'department',
        'email',
        'phone',
    ];

    protected $guarded = ['id'];

    public function files()
    {
        return $this->hasMany(ExhibitionRegistrationFile::class, 'registration_id');
    }

    public function departmentRef()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
