<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required',
            'valor' => 'required|max:10',
            'vencimento' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Campo nome eh obrigatorio',
            'valor.required' => 'Campo valor eh obrigatorio',
            'valor.max' => 'Campo valor so pode ter no maximo 8 numeros',
            'vencimento.required' => 'Campo vencimento eh obrigatorio',
        ];
    }
}
