<?php

namespace Modules\Boards\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createBoards extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "boardname" => 'required|max:32|min:2',
            "keywords" => 'required|max:32|min:1'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
