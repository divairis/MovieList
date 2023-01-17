<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storeuser_profileRequest extends FormRequest
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
        if($this->request->get('image_url')){
            $rules = ['image_url' => 'required'];
        }else{
            $rules = [
                'username' => 'required|min:5',
                'email' => 'required|email:dns',
                'dob' => 'required|date',
                'number' => 'required|min:5|max:13',
            ];
        }

        return $rules;
    }
}
