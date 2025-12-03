<?php

namespace App\Imports;

use App\Models\Modification;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CatalogImport implements ToCollection, WithHeadingRow
{
	public function collection(Collection $rows)
    {
	//dd($rows);
        foreach ($rows as $row) 
        {
		dd($row);
		Modification::updateOrInsert(
	        //['email' => 'john@example.com', 'name' => 'John'],
	        //['votes' => '2', 'votes2' => '3', 'votes3' => '4']
	    );
        }
    }
}
