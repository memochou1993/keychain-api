<?php

namespace App\Http\Requests;

use App\Rules\ElementsInArray;
use Illuminate\Foundation\Http\FormRequest;

class KeyRequest extends FormRequest
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
            case 'keys.index':
                return [
                    'search' => [
                        'boolean',
                        'nullable',
                    ],
                    'with' => [
                        new ElementsInArray([
                            'user',
                        ]),
                        'nullable',
                    ],
                    'paginate' => [
                        'integer',
                        'min:1',
                        'nullable',
                    ],
                ];

            case 'keys.show':
                return [
                    'password' => [
                        'required',
                    ],
                ];

            case 'keys.store':
            case 'keys.update':
                return [
                    'title' => [
                        'required',
                    ],
                    'content' => [
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
