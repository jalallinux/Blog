<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() && $this->user()->id == $this->post->user_id;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('crud.forbidden'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'caption' => ['required', 'string', 'max:250'],
            'body' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id']
        ];
    }
}
