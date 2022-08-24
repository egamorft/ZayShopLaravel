<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class OrderExportController extends Controller
{
    private $excel;
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    public function export()
    {
        return $this->excel->download(new ExcelExport(), 'order.xlsx');
    }
}
