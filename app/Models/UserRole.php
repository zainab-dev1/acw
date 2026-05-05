<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function role()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }
}