<?php
 namespace App\Http\Requests;
 use Illuminate\Foundation\Http\FormRequest;

 class BankRequest extends FormRequest
{
 public function authorize()
  {
      return true;
  }
 public function rules()
  {
   return [
      'name' => "",
      'description' => ""   ];
  }
  public function messages(): array
  {
    return [
    ];
  }
}
