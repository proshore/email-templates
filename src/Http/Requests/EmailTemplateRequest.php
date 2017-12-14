<?php

namespace Proshore\EmailTemplates\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    public function postMergeRule($rules,$attribute,$rule)
    {
        if($this->method == 'POST') {
            return array_add($rules,$attribute,$rule);
        }
        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title'   => 'required',
            'subject' => 'required',
            'content' => 'required'
        ];

        $this->postMergeRule($rules,'slug','required');

        return $rules;
    }
}
