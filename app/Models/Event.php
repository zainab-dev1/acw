<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    use FormAccessible;

    protected $table = 'events';

    protected $guarded = ['id'];

    protected $casts = [
        'has_attachment' => 'boolean',
        'has_feedback' => 'boolean',
        'has_certificate' => 'boolean',
        'has_participant_limit' => 'boolean',
        'is_open' => 'boolean',
    ];

    public function type()
    {
        return $this->hasOne(EventType::class,'id','survey_type_id');
    }

    public function results()
    {
        return $this->hasMany(EventResult::class,'survey_id','id');
    }

    public function attendances()
    {
        return $this->hasMany(EventAttendance::class,'survey_id','id');
    }

    public function getTrainingDateAttribute($value)
    {
        if (!$value) return null;
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function formTrainingDateAttribute($value)
    {
        if (!$value) return null;
        return Carbon::parse($value)->format('Y-m-d');
    }

}
