<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Auth::check(); // só permite se estiver logado
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'body' => 'required|string',
            'visibility' => 'required|in:public,friends,private',
            'images.*' => 'nullable|image|max:2048',
            'allow_comments' => 'sometimes|boolean',
            'type' => 'sometimes|in:post,comment,work', // novo campo
            'parent_id' => 'nullable|exists:posts,id', // se for comentário
        ];
    }
}
