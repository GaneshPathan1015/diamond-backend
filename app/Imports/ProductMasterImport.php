<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductMasterImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Sheet1' => new CombinedProductImport(),
        ];
    }
}