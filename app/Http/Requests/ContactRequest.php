<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if (Request::isMethod('post')) {
            return [
                'name' => 'required',
                'email' => 'nullable|email',
                'phone_no' => 'required|unique:contacts,phone_no',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            ];
        } else {
            $currentId = Request::segment(3);
            return [
                'name' => 'required',
                'isFavorite' => 'required',
                'email' => 'nullable|email',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
                'phone_no' => [
                    'required',
                    Rule::unique('contacts')->where(function ($query) use ($currentId) {
                        return $query->where('id', '<>', $currentId);
                    })

                ],
            ];

        }
    }
}
