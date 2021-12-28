<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    private $table='article';
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
        $mimes='mimes:jpg,jpeg,png,bmp,gif,svg,webp';
        $condThumb= "bail|required|$mimes|max:1000";
        $condName = "bail|required|between:5,100|unique:$this->table,name";
        if(!empty($id)){
            $condThumb= "bail|$mimes|max:1000";
            $condName = "bail|required|between:5,100|unique:$this->table,name,$id";
        }
        return [
            'name'          => $condName,
            'content'   => 'bail|required',
            'status'        => 'bail|required|in:active,inactive',
            'thumb'        => $condThumb,
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
