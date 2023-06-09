<?php

namespace App\Http\Requests;

use App\Rules\MaxPosts;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StorePostRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
    // dd($this->all());
        return [
            'title'=>['required','min:3','unique:posts,title,'.$this->post],
            'description'=>['required','min:10'],
            // 'slug'=>'unique:posts',
            
            'creator' => ['required','exists:users,id'],
            'image'=> ['mimes:jpg,jpeg,png,gif'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.unique' => 'Post title must be unique',
            'title.required' => 'Post title is required',
            'title.min' => 'Post title must be minimum 3 words',
            'description.required' => 'Post description is required',
            'description.min' => 'Post description must be minimum 10 words',
        ];
    }


}