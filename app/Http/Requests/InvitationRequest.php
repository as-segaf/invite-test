<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
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
            'full_name' => 'required',
            'nick_name' => 'required',
            'wa_number' => 'required',
            'organization_type' => 'required',
            'organization_name' => 'required',
            'invite_vos_as' => 'required',
            'event_type' => 'required',
            'event_date' => 'required|date|after_or_equal:today',
            'event_place' => 'required',
            'event_detail' => 'required',
            'participant' => 'required',
        ];
    }
}
