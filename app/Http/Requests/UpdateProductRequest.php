<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Type\Integer;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'stock' => $this->convertCurrencyToBigInt($this->stock),
            'stock_recondition' => $this->convertCurrencyToBigInt($this->stock_recondition),
            'price' => $this->convertCurrencyToBigInt($this->price),
            'price_recondition' => $this->convertCurrencyToBigInt($this->price_recondition),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('product') ? $this->route('product')->id : null;

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('products', 'name')->ignore($id),
            ],
            'status' => ['required'],
            'stock' => ['required', 'integer'],
            'stock_recondition' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'price_recondition' => ['required', 'integer']
        ];
    }


    private function convertCurrencyToBigInt($value): int
    {
        if (!$value) {
            return 0;
        }

        // Hilangkan semua karakter kecuali angka dan koma
        $value = preg_replace('/[^\d,]/', '', $value);
        $value = str_replace(',', '.', $value);
        $value = str_replace('.', '', $value);

        return (int) $value;
    }
}
