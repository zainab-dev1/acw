<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class VisitDateRequestRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //dd(Carbon::parse($value)->diffInDays(Carbon::parse($value)->addWeek(), false));
        $total_days = Carbon::now()->startOfDay()->diffInDays(Carbon::parse($value)->endOfDay(), false);

        if ($total_days < 7) {
            return false;
        } else {
            return true;
        }

        //dd($total_days);
        //return $total_days >= (new Carbon($value))->addWeeks() ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You Need to request 7 days ahead';
    }
}