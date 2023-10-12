<?php

namespace App\Http\Requests;

use App\Rules\PersianDateRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateDailyItemReq extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "point"=>["required","between:1,10"],
            "name"=>["required","string"],
            "category"=>["required","between:1,8"],
            "time" => ["nullable","date_format:H:i"]
        ];
    }
}
