<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    private $table='category';
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
        
        $id = $this->id;

        $condName = "bail|required|between:5,100|unique:$this->table,name";
        if(!empty($id)){
            $condName = "bail|required|between:5,100|unique:$this->table,name,$id";
        }
        return [
            'name'          => $condName,
            'status'        => 'bail|required|in:active,inactive',
            'is_home'       => 'bail|required|in:1,0',
            'display'       => 'bail|required|in:grid,list'
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
