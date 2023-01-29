<?php
declare(strict_types=1);

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'release_at' => ['required'],
            'content'    => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'release_at.required' => '日にちは必須です',
            'content.required'    => '内容は必須です',
            'content.max'         => '255文字以内で入力してください',
        ];
    }
}
