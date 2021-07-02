<?php

namespace App\Exports;

use App\Models\InventoryHistory;
use App\Models\Employee;
use App\Models\Equipment;
use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;


class InventoryExport implements FromView
{
    public function view(): View
    {
        $data = InventoryHistory::all();
           
        return view('inventory_histories.export')
                        ->with(compact('data'));
    }
}