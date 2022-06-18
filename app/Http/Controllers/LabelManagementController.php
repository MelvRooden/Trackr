<?php

namespace App\Http\Controllers;

use App\Imports\LabelImport;
use App\Models\Label;
use App\Models\PackageStatus;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class LabelManagementController extends Controller
{
    public function index()
    {
        $labels = Label::All();

        return view('labelManagement.index', ['labels' => $labels]);
    }

    public function apiGetMyLabels()
    {

    }

    public function apiStoreMyLabel()
    {
    }


    public function storeCSVFile(Request $request)
    {
        $barcode = Label::generateLabelCode();
        $packageStatus = PackageStatus::findOrFail(1)->get();

        if ($barcode && $packageStatus) {
            Excel::import(new Label([
                'barcode_id' => $barcode,
                'package_status_id' => $packageStatus,
                'carrier_user_id' => $request[0],
                'sender_user_id' => $request[1],
                'sender_address' => $request[2],
                'sender_postcode' => $request[3],
                'sender_city' => $request[4],
                'receiver_user_id' => $request[5],
                'receiver_address' => $request[6],
                'receiver_postcode' => $request[7],
                'receiver_city' => $request[8]
            ]), $request->file('csvFile'));
        } else {
            return back()->with('messages.error', 'attributes.label.error.added');
        }

        return back()->with('messages.success', 'attributes.label.success.added');
    }
}
