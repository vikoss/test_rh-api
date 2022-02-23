<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class EmployeeRequest extends FormRequest
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
        return [
            'name'          => 'required',
            'surname'       => 'required',
            'dni'           => 'required',
            'date_of_birth' => 'required',
            'photo'         => 'nullable',
            //'photo_file'    => 'required',//max:2048
            'user_id'       => 'nullable'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name'          => $this->name,
            'surname'       => $this->surname,
            'dni'           => $this->dni,
            'date_of_birth' => $this->date_of_birth,
            'photo'         => $this->photo_file->store('photos', 'public'),
            'user_id'       => $this->user_id,
        ]);
    }
}
