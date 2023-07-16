<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TasksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:255'],
            'complete' => ['string', 'max:1']
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'O campo description é obrigatória.',
            'description.string' => 'O campo description deve ser uma string.',
            'description.max' => 'O campo description deve ter no máximo 255 caracteres.',
            'complete.required' => 'O campo complete é obrigatório.',
            'complete.string' => 'O campo complete deve ser uma string.',
            'complete.max' => 'O campo complete deve ter no máximo 1 character.'
        ];
    }

    public function toArray(): array
    {
        return [
            'description_task' => $this->description,
            'complete_task' => $this->complete ?? "F",
            'user_id_task' => Auth::User()->id
        ];
    }
}
