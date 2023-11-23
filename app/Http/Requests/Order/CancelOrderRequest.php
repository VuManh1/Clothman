<?php

namespace App\Http\Requests\Order;

use App\Repositories\Interfaces\OrderRepository;
use Illuminate\Foundation\Http\FormRequest;

class CancelOrderRequest extends FormRequest
{
    public function __construct(
        private OrderRepository $orderRepository
    ) {}

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $order = $this->orderRepository->findByCode($this->route('code'));

        return $order && $this->user()->can('cancel-order', $order);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function getValidatorInstance()
    {
        $this->applyCancelReason();

        return parent::getValidatorInstance();
    }

    protected function applyCancelReason()
    {
        $this->merge([
            'cancel_reason' => $this->input('cancel_reason_other') ? $this->input('cancel_reason_other') : $this->input('cancel_reason')
        ]);
    }
}
