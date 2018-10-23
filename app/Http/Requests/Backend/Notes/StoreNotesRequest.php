<?php

namespace App\Http\Requests\Backend\Notes;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-note');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'          => 'required|max:191',
            'featured_image' => 'required',
            'content'        => 'required',
        ];
    }

    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Please insert Note Title',
            'title.max'      => 'Note Title may not be greater than 191 characters.',
        ];
    }
}
