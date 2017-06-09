<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GetChallengeRequest extends FormRequest
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
        	'phase' => 'numeric',
            'allPhases' => 'boolean',
	        'resources' => 'boolean',
	        'questions' => 'boolean|required_with:groupInsightsByQuestion',
	        'insights' => 'boolean|required_with:insightTypes,groupInsightsByQuestion',
	        'insightTypes' => 'string|numberList',
	        'groupInsightsByQuestion' => 'boolean',
        ];
    }
}
