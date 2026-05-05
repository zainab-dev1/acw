<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventOtherAttendance extends Model
{
    use HasFactory;

    protected $table = 'event_other_attendance';
    
    protected $guarded = ['id'];
}
