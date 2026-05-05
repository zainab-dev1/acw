<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;

class Activity extends Model
{
    use HasFactory;
    use FormAccessible;

    /**
     * We keep the physical table name as `events` for backward compatibility.
     */
    protected $table = 'events';

    protected $guarded = ['id'];

    public function type()
    {
        return $this->hasOne(EventType::class, 'id', 'survey_type_id');
    }

    public function results()
    {
        return $this->hasMany(EventResult::class, 'survey_id', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(EventAttendance::class, 'survey_id', 'id');
    }

    public function detail()
    {
        return $this->hasOne(ActivityDetail::class, 'activity_id', 'id');
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

    public function getTimeAttribute($value)
    {
        if (!$value) return null;
        // Stored as TIME (HH:MM:SS). Return a Carbon instance for convenient formatting.
        return Carbon::createFromFormat('H:i:s', $value);
    }

    public function formTimeAttribute($value)
    {
        if (!$value) return null;
        // For <input type="time">
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }
}
