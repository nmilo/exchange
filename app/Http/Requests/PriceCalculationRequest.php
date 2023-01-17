<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceCalculationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'purchased_currency_id' => 'required|integer',
            'sold_currency_id' => 'required|integer',
            'purchased_amount' => 'required|numeric|regex:'.$this->getTopTenRegex(),
        ];
    }

    /**
     * @return string
     */
    private function getTopTenRegex(): string
    {
        return '/^(([0-9]*)(\.([0-9]+))?)$/';
    }
}
