<?php

namespace App\Services;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImportService implements ToArray, WithHeadingRow
{
    public function array(array $array)
    {
        return $array;
    }
}
