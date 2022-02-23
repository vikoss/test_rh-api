<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'name'      => 'required',
            'code'      => 'required',
            'level'     => 'required',
            'is_boss'   => 'required',
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
            'name'      => $this->name,
            'code'      => $this->code,
            'level'     => $this->level,
            'is_boss'   => $this->is_boss === 'true' ? true : ($this->is_boss === 'false' ? false : $this->is_boss),
        ]);
    }
}
