<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
            "name"=>["required","string",Rule::unique('employees')->ignore($this->employee->id ?? null),]
        ];      


        // ??null   برای زمان ایجاد
        // $id = null;
        // if (isset($this->employee) && isset($this->employee->id)     ) {
        //    $id = $this->employee->id;
        // }    

    }
}
