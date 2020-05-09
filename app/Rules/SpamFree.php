<?php

namespace App\Rules;

use App\Inspections\Spam;
use Exception;
use Illuminate\Contracts\Validation\Rule;

class SpamFree implements Rule
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
        try{
            (new Spam)->detect($value);
        } catch(Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the :attribute contains spam';
    }
}
