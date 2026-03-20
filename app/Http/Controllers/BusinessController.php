<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Imports\BusinessesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    // Feature C: The Report Dashboard
    public function index()
    {
        $totalName = Business::count();
        
        $cityWise = Business::select('city', DB::raw('count(*) as total'))->groupBy('city')->get();
        
        $categoryCityWise = Business::select('category', 'city', DB::raw('count(*) as total'))->groupBy('category', 'city')->get();
        
        $categoryAreaWise = Business::select('category', 'area', DB::raw('count(*) as total'))->groupBy('category', 'area')->get();
        
        // Count unique groupings
        $uniqueListing = DB::table('businesses')
            ->select('business_name', 'area', 'city')
            ->groupBy('business_name', 'area', 'city')
            ->havingRaw('COUNT(*) = 1')
            ->count();

        // Identify Duplicate Groups
        $duplicateGroups = Business::select('business_name', 'area', 'city', DB::raw('COUNT(*) as count'))
            ->groupBy('business_name', 'area', 'city')
            ->havingRaw('COUNT(*) > 1')
            ->get();
        
        $duplicateListingCount = $duplicateGroups->sum('count');

        // Incomplete Listings
        $incompleteListing = Business::whereNull('mobile_no')
            ->orWhereNull('category')
            ->orWhereNull('sub_category')
            ->count();

        return view('dashboard', compact(
            'totalName', 'cityWise', 'categoryCityWise', 'categoryAreaWise', 
            'uniqueListing', 'duplicateListingCount', 'incompleteListing', 'duplicateGroups'
        ));
    }

    // Feature A: Handle File Upload
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv']);
        Excel::import(new BusinessesImport, $request->file('file'));
        return redirect()->back()->with('success', 'Data Imported Successfully!');
    }

    // Feature B: Merge Duplicates
    public function mergeDuplicates()
    {
        $duplicates = Business::select('business_name', 'area', 'city')
            ->groupBy('business_name', 'area', 'city')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            $records = Business::where('business_name', $duplicate->business_name)
                               ->where('area', $duplicate->area)
                               ->where('city', $duplicate->city)
                               ->orderBy('id', 'asc')
                               ->get();

            $primaryRecord = $records->first();

            foreach ($records->skip(1) as $record) {
                if (empty($primaryRecord->mobile_no) && !empty($record->mobile_no)) {
                    $primaryRecord->mobile_no = $record->mobile_no;
                }
                $record->delete();
            }
            $primaryRecord->save();
        }

        return redirect()->back()->with('success', 'Duplicates merged successfully!');
    }
}