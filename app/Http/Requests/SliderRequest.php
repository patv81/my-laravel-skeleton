<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            // 'name'          => 'bail|required|min:5',
            // 'description'   => 'bail|required',
            // 'link'           => 'bail|required|min:5|url',
            // 'status'        => 'bail|required|in:active,inactive',
            'thumb'        => 'bail|required|image',
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
