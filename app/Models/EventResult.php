<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventResult extends Model
{
    use HasFactory;

    protected $table = 'event_results';

    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo(Event::class,'survey_id','id');
    }
}
