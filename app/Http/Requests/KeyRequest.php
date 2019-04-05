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
        switch($this->method()) {
            case 'GET':
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
                ];

            case 'POST':
            case 'PUT':
            case 'PATCH':
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
