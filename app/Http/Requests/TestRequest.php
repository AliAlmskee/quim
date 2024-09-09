<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' =>'required|integer',
            'hadith_id' => 'required|integer',
            'audio_id' => 'required|integer',
            'quarter_id' => 'required|integer',
            'mark' => 'required|integer',
            'points_added' => 'required|integer',
        ];
    }
}
