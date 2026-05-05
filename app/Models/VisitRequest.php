<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function activity_type()
    {
        return $this->hasOne(VisitActivityType::class,'id','visit_activity_type_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function section()
    {
        return $this->hasOne(Section::class,'id','section_id');
    }

    public function participant()
    {
        return $this->hasOne(VisitParticipant::class,'id','visit_participant_id');
    }

    public function status()
    {
        return $this->hasOne(VisitStatus::class,'id','visit_status_id');
    }

    public function ay()
    {
        return $this->hasOne(AcademicYear::class,'id','academic_year_id');
    }

    public function requested_by()
    {
        return $this->hasOne(User::class,'id','requested_by_user_id');
    }
}
