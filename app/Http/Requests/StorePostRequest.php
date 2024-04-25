<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:posts', 'min:3'],
            'body' => ['required', 'string','min:10'],
            'user_id' => [ 'numeric', 'exists:users,id'],
            'comment' => ['nullable', 'string'],
            'image' => ['nullable', 'file', 'mimetypes:image/png,image/jpeg,image/jpg'],
        ];
    }

/**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
public function messages(): array
{
        return [
            'name.required' => 'You must enter a name for the post.',
            'name.string' => 'The name must be a string.',
            'name.unique' => 'The name must be unique.',
            'name.max' => 'The name must not exceed 255 characters.',
            'body.required' => 'You must enter a body for the post.',
            'body.string' => 'The body must be a string.',
            'user_id.numeric' => 'The user ID must be a number.',
            'user_id.exists' => 'The specified user does not exist.',
            'comment.string' => 'The comment must be a string.',
            'image.mimes' => 'The image must be a file of type: jpg, png.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
        ];
    }
}
