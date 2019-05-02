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
            case 'users.me.keys.index':
                return [
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
                    'scout' => [
                        'boolean',
                        'nullable',
                    ],
                ];

            case 'users.me.keys.show':
                return [
                    'with' => [
                        new ElementsInArray([
                            'user',
                        ]),
                        'nullable',
                    ],
                ];

            case 'users.me.keys.store':
            case 'users.me.keys.update':
                return [
                    'title' => [
                        'required',
                    ],
                    'content' => [
                        'required',
                    ],
                    'with' => [
                        new ElementsInArray([
                            'user',
                        ]),
                        'nullable',
                    ],
                ];

            default:
                return [
                    //
                ];
        }
    }
}
