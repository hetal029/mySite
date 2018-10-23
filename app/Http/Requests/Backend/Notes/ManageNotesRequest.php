<?php

namespace App\Http\Requests\Backend\Notes;

use Illuminate\Foundation\Http\FormRequest;

class ManageNotesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         return access()->allow('view-note');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
