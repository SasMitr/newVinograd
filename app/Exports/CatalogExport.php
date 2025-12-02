<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use App\Models\Vinograd\Product;
use App\Models\Vinograd\User;

class CatalogExport implements FromArray
{
	public function array(): array
    {
	$array = [];
	$products = Product::query()->select('id', 'name')->with('adminModifications')->orderBy('name')->get();
	foreach ($products as $product) {
		$temp = [$product->id, $product->name];
		$groupBy = $product->adminModifications->groupBy('modification_id');
		
		$temp[] = 'черенок';
		$temp[] = $groupBy->has(1) ? $groupBy[1][0]->quantity : 0;
		$temp[] = 'цена';
		$temp[] = $groupBy->has(1) ? $groupBy[1][0]->price : 0;

		$temp[] = 'саженец';
		$temp[] = $groupBy->has(3) ? $groupBy[3][0]->quantity : 0;
		$temp[] = 'цена';
		$temp[] = $groupBy->has(3) ? $groupBy[3][0]->price : 0;

		$array[] = $temp;	
	}
        return $array;
    }
}
