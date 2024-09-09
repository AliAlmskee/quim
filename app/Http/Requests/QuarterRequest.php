<?php

// app/Http/Requests/QuarterRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuarterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }
}
