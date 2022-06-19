<?php

namespace App\Http\Controllers;

use App\Http\Requests\Label\StoreCsvRequest;
use App\Imports\LabelImport;
use App\Imports\LabelImportCsv;
use App\Models\Label;
use App\Models\PackageStatus;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class LabelManagementController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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

    /**
     * @param StoreCsvRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCSVFile(StoreCsvRequest $request)
    {
        $barcode = Label::generateLabelCode();
        $packageStatus = PackageStatus::findOrFail(1)->get();

        if ($barcode != null && $packageStatus != null) {
            Excel::import(new LabelImportCsv(), $request->file('csvFile'));
        } else {
            return back()->with('messages.error', 'attributes.label.error.added');
        }

        return back()->with('messages.success', 'attributes.label.success.added');
    }
}
