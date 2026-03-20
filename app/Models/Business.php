<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    // This line allows our bulk importer to insert data into these specific columns
    protected $fillable = [
        'business_name', 
        'area', 
        'city', 
        'mobile_no', 
        'category', 
        'sub_category'
    ];
}