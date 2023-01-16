<?php

namespace App\Http\Requests\Consultation;

use App\Models\MasterData\Consultation;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

// only use in update request
use Illuminate\Validation\Rule;


class UpdateConsultationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('consultation_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
            'name' => 'required|string|max:255', Rule::unique('consultation')->ignore($this->consultation)
        ];
    }
}
