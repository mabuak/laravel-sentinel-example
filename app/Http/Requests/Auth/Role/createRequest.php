<?php

namespace App\Http\Requests\Auth\Role;

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
			'name' => 'required|unique:roles|regex:/(^[A-Za-z0-9_-_ ]+$)+/',
		];
	}
}
