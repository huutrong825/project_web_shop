<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'txtname'=>'required|min:5',
            'email'=>'required|unique:users|',
            'password'=>'required|min:6|',
            'repass'=>'required|same:password',
            'group_role'=>'required'
        ];
    }

    public function messages(){
        return[
            'txtname.required'=>'Tên không được trống',
            'txtname.min'=>'Tên không được nhỏ hơn :min ký tự',
            'email.required'=>'Email không được trống',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Mật khẩu không được trống',
            'password.min'=>'Mật khẩu không được nhỏ hơn :min ký tự',
            'repass.required'=>'Mật khẩu xác nhận không được trống',
            'repass.same'=>'Mật khẩu xác nhận chưa đúng',
            'group_role.required'=>'Chưa chọn nhóm người dùng',
        ];
    }
}
