<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $route = $this->route() ? $this->route()->getName() : null;

        switch($route) {
            case 'auth.password.reset':
                return [
                    'old_password' => [
                        'required',
                    ],
                    'new_password' => [
                        'min:8',
                        'required',
                    ],
                ];

            default:
                return [
                    //
                ];
        }
    }
}
