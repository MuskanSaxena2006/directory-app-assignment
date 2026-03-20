<?php

namespace App\Imports;

use App\Models\Business;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BusinessesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // The CSV header is "Name", which Laravel converts to "name"
        if (!isset($row['name']) || trim($row['name']) === '') {
            return null; 
        }

        // Insert valid rows by mapping the CSV columns to our database columns
        return new Business([
            'business_name' => $row['name'],           // From CSV: "Name"
            'area'          => $row['area'] ?? null,       // From CSV: "area"
            'city'          => $row['city'] ?? null,       // From CSV: "city"
            'mobile_no'     => $row['phone1'] ?? null,     // From CSV: "phone1"
            'category'      => $row['category'] ?? null,   // From CSV: "Category"
            'sub_category'  => $row['subcategory'] ?? null,// From CSV: "SubCategory"
        ]);
    }
}