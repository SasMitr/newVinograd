<?php

namespace App\Imports;

use App\Models\Vinograd\Modification;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CatalogImport implements ToCollection, WithHeadingRow
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
}
