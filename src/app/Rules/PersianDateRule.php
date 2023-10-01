<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PersianDateRule implements Rule
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
        return $this->validateShamsiDate($attribute, $value,[]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
    public function validateShamsiDate($attribute, $value, $parameters)
    {
        if (isset($parameters[0]) && $parameters[0] == 'persian') {
            $value = $this->faToEnNumbers($value);
        }

        $jdate = preg_split('/(\-|\/)/', $value);
        return (count($jdate) === 3 && $this->isValidjDate($jdate[0], $jdate[1], $jdate[2]));
    }
    private function isValidjDate($year, $month, $day) {
        if($year < 0 || $year > 32766) {
            return false;
        }
        if($month < 1 || $month > 12) {
            return false;
        }

        $daysMonthJalali = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
        $dayLastMonthJalali = in_array(($year % 33) , [1 , 5 , 9 , 13 ,17 , 22 , 26 , 30]) && ($month == 12) ? 30 : $daysMonthJalali[intval($month)-1];
        if($day < 1 || $day > $dayLastMonthJalali) {
            return false;
        }

        return true;
    }
    private function faToEnNumbers($string)
    {
        $fa_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $en_num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($fa_num, $en_num, $string);
    }
}
