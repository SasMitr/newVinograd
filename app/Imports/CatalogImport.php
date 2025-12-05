<?php

namespace App\Imports;

use App\Models\Vinograd\Modification;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class CatalogImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
	public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Modification::updateOrCreate(
                ['product_id' => $row['product_id'], 'modification_id' => $row['modification_id']],
                ['price' => $row['price'], 'quantity' => $row['quantity'] ?: 0, 'in_stock' => $row['quantity'] ?: 0]
            );
        }
    }

    public function rules(): array
    {
        return [
            'modification_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'nullable|integer',
            'price' => 'required_with:*.quantity|nullable|integer'
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $map = [];
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $error) {
                $map[] = 'Ошибка в строке-' . $failure->row() . ': ' .$error;
            }
        }

        if (count($map) > 0) {
            throw ValidationException::withMessages($map);
        }
    }

    public function customValidationAttributes()
    {
        return [
            'quantity' => '[ Количество ]',
            'price' => '[ Цена ]'
        ];
    }
}
