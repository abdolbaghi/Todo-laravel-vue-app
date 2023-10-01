<?php

namespace App\Http\Requests;

use App\Rules\PersianDateRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateItemReq extends FormRequest
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
            "date" => ["requires",new PersianDateRule()],
            "point"=>["requires","between:1,10"],
            "name"=>["requires","string"],
            "category"=>["requires","between:1,8"],
        ];
    }
}
