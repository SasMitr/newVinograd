<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Vinograd\Product;

class CatalogExport implements FromArray, WithHeadings
{
    protected $modification_id;

    public function __construct(int $modification_id)
    {
        $this->modification_id = $modification_id;
    }

	public function array(): array
    {
        $catalogTable = [];
        $products = Product::query()->select('id', 'name')->with('adminModifications')->orderBy('name')->get();
        foreach ($products as $product) {

            $row = [$this->modification_id];
            $row[] = $product->id;
            $row[] = $product->name;
            $groupBy = $product->adminModifications->groupBy('modification_id');

            $row[] = $groupBy->has($this->modification_id) ? $groupBy[$this->modification_id][0]->quantity : 0;
            $row[] = $groupBy->has($this->modification_id) ? $groupBy[$this->modification_id][0]->price : 0;

            $catalogTable[] = $row;
        }
        return $catalogTable;
    }

// залоловки
	public function headings(): array
    {
        return [
            'modification_id',
            'product_id',
            'product_name',
            'quantity',
	        'price'
        ];
    }
}
