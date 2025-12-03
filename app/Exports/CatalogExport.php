<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Vinograd\Product;
use App\Models\Vinograd\User;

class CatalogExport implements FromArray, WithHeadings
{
	public function array(): array
    {
	$catalogTable = [];
	$products = Product::query()->select('id', 'name')->with('adminModifications')->orderBy('name')->get();
	foreach ($products as $product) {
		$row = [$product->id, $product->name];
		$groupBy = $product->adminModifications->groupBy('modification_id');
		
		$row[] = 'черенок';
		$row[] = $groupBy->has(1) ? $groupBy[1][0]->quantity : 0;
		$row[] = 'цена';
		$row[] = $groupBy->has(1) ? $groupBy[1][0]->price : 0;

		$row[] = 'саженец';
		$row[] = $groupBy->has(3) ? $groupBy[3][0]->quantity : 0;
		$row[] = 'цена';
		$row[] = $groupBy->has(3) ? $groupBy[3][0]->price : 0;

		$catalogTable[] = $row;	
	}
        return $catalogTable;
    }

// залоловки
	public function headings(): array
    {
        return [
            'product_id',
            'product_name',
            'черенок',
	    'quantity_ch',
            'цена_ch',
            'price_ch',
	    'саженец',
            'quantity_s',
            'цена_s',
	    'price_s'
        ];
    }
}
