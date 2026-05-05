<?php

namespace App\Http\Requests;

use App\Rules\VisitDateRequestRule;
use Illuminate\Foundation\Http\FormRequest;

class VRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'visit_activity_type_id' => 'required',
            'department_id' => 'required',
            'section_id' => 'required',
            'visit_participant_id'=> 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'committee_course_name' => 'required',
            'title_visit' => 'required',
            'industry_experts' => 'required',
            'proposed_date' => ['required','date', new VisitDateRequestRule()]
        ];
    }
}

//'proposed_date' => ['required','date', new VisitDateRequestRule()]