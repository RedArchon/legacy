<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReminderRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'channel' => 'string|required|in:mail,database',
            'message' => 'string|required|max:255',
            'time' => 'date|required',
            'email' => 'sometimes|required_if:channel,mail|email'
        ];
    }
}
