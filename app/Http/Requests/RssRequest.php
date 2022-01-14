<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RssRequest extends FormRequest
{
    private $table='slider';
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
        $condSource = 'bail|required|in:'. implode(',',array_keys(config('myconf.template.rss_source')));
        
        return [
            'name'          => $condName,
            'link'           => 'bail|required|min:5|url',
            'status'        => 'bail|required|in:active,inactive',
            'source'        => $condSource,
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name không được rỗng',
            'name.min' => 'Name :input phải ít nhất là :min kí tự',
        ];
    }
}
