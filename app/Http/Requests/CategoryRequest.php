<?php
 namespace App\Http\Requests;
 use Illuminate\Foundation\Http\FormRequest;

 class CategoryRequest extends FormRequest
{
 public function authorize()
  {
      return true;
  }
 public function rules()
  {
   return [
      'name' => ['required'],
      'description' => ['required'],
      'short' => ['required'],
      'parent_id' => "",
      'reference' => ['required'],
      'user_id' => ""   ];
  }
  public function messages(): array
  {
    return [
      'name.required' => ':attribute can not be empty.',
      'description.required' => ':attribute can not be empty.',
      'short.required' => ':attribute can not be empty.',
      'reference.required' => ':attribute can not be empty.'    ];
  }
}
