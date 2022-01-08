<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->id;
        $task = $this->task;
        $mimes='mimes:jpg,jpeg,png,bmp,gif,svg,webp';


        $condAvatar='';
        $condEmail='';
        $condPassword='';
        $condUserName='';
        $condFullName='';
        $condLevel='';
        $condStatus='';
        
        switch($task){
            case 'add':
                $condUserName = "bail|required|between:5,100|unique:$this->table,username";
                $condEmail = "bail|required|email|unique:$this->table,email";
                $condAvatar = "bail|required|$mimes|max:1000";                
                $condFullName='bail|required|min:5';
                $condStatus ='bail|required|in:active,inactive';
                break;
            case 'edit-info':
                $condUserName = "bail|required|between:5,100|unique:$this->table,username,$id";
                $condEmail = "bail|required|email|unique:$this->table,email,$id";
                $condAvatar = "bail|$mimes|max:1000";
                break;
            case 'change-password':
                $condPassword = "bail|required|between:2,32|confirmed";
                break;
            case 'change-level':

                $condLevel = 'bail|required|in:member,admin';
                break;
        }
        // $condThumb= "bail|required|$mimes|max:1000";
        return [
            'username'      => $condUserName,
            'email'         => $condEmail,
            'fullname'      => $condFullName,
            'status'        => $condStatus,//
            'level'         => $condLevel,//
            'avatar'        => $condAvatar,
            'password'      => $condPassword,
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
