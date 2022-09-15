<?php

namespace App\Http\Controllers;

use App\Exports\SupplierExport;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    function index()
    {
        $supplier_data = DB::table('supplier')->get();
        return view('export_excel')->with('supplier_data', $supplier_data);
    }

    function excel()
    {
//        $supplier_data = DB::table('supplier')->get()->toArray();
//        $supplier_array[] = array('Code', 'Name', 'Email', 'Phone', 'Location', 'Min quantity', 'Max quantity', 'Num employee');
//        foreach ($supplier_data as $supplier)
//        {
//            $supplier_array[] = array(
//                'Code' => $supplier->sp_code,
//                'Name' => $supplier->sp_name,
//                'Email' => $supplier->sp_email,
//                'Phone' => $supplier->sp_phone,
//                'Location' => $supplier->sp_location,
//                'Min quantity' => $supplier->sp_minQuantity,
//                'Max quantity' => $supplier->sp_maxQuantity,
//                'Num employee' => $supplier->sp_numEmployee,
//            );
//        }
//
//        Excel::create('Supplier Data', function ($excel) use ($supplier_array){
//            $excel->setTitle('Supplier Data');
//            $excel->sheet('Supplier Data', function ($sheet) use ($supplier_array){
//                $sheet->fromArray($supplier_array, null, 'A1', false, false);
//            });
//        })->download('data_supplier.xls');
    }
}
