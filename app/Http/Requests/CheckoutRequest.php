<?php

namespace CodeDelivery\Http\Requests;

class CheckoutRequest extends Request
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
        $rules = [
            'coupon_code' => 'exists:coupons,code,used,0'
        ];

        $this->buildItemRule(0, $rules);

        $items = $this->get('items', []);
        $items = !is_array($items) ? [] : $items;

        foreach ($items as $key => $value) {
            $this->buildItemRule($key, $rules);
        }

        return $rules;
    }

    public function buildItemRule($key, array &$rules)
    {
        $rules['items.' . $key . '.product_id'] = 'required';
        $rules['items.' . $key . '.qtd'] = 'required';
    }
}
