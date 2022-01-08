<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\AuthLoginRequest as MainRequest;
class AuthLoginRequest extends FormRequest
{
    private $table='user';
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
            'email'     =>'bail|required|email',
            'password'  => 'bail|required|between:2,32',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name không được rỗng',
            'name.min' => 'Name :input phải ít nhất là :min kí tự',
            'description.required'  => 'Không được rỗng',
        ];
    }
}
