<?php

namespace App\Http\Requests\Auth\User;

use Illuminate\Foundation\Http\FormRequest;

class createRequest extends FormRequest {
	
	
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
        return [
            'first_name' => 'required|regex:/(^[A-Za-z0-9_-_ ]+$)+/',
            'last_name'  => 'required|regex:/(^[A-Za-z0-9_-_ ]+$)+/',
            'email'      => 'required|unique:users|email',
            'role'       => 'required',
            'password'   => 'required|confirmed|min:8',
        ];
	}
	
	/**
	 * Get the message
	 *
	 * @return array
	 */
	public function messages() {
		return [
			//
		];
	}
}
