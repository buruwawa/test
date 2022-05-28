<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\outstandingExport;
use App\Exports\salesExport;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    //
    public function importExportView()
    {
       return view('admin.excels.importexport');
    }
    public function export()
    {

    }
    public function order_export()
    {
        return Excel::download(new salesExport, 'Sales.xlsx');
    }
    public function outstandings_export()
    {
        return Excel::download(new outstandingExport, 'Outstandings.xlsx');
    }
}
