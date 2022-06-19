<?php

namespace App\Http\Controllers;

use App\Http\Requests\Label\StoreCsvRequest;
use App\Imports\LabelImport;
use App\Imports\LabelImportCsv;
use App\Models\Label;
use App\Models\PackageStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class LabelManagementController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $user_id = Auth::id();
        $search_param = $request->query('q');

        if (Auth::user()->can('viewAny', User::class)) {
            if ($search_param) {
                $labels = Label::search($search_param);
            } else {
                $labels = Label::All();
            }
        } else if ($search_param) {
            $labels = Label::search($search_param)
                ->where('carrier_user_id', $user_id)
                ->orWhere('sender_user_id', $user_id)
                ->orWhere('receiver_user_id',$user_id)
                ->orderBy('package_status_id', 'ASC')
                ->get();
        } else {
            $labels = Label::search($search_param)->where('carrier_user_id', $user_id)
                ->orWhere('sender_user_id', $user_id)
                ->orWhere('receiver_user_id', $user_id)
                ->orderBy('package_status_id', 'ASC')
                ->get();
        }

        return view('labelManagement.index', ['labels' => $labels]);
    }

    public function showByBar($barCode_id = null)
    {
        $labels = Label::where('barCode_id', $barCode_id)->get();

        return view('labelManagement.showByBar', ['labels' => $labels]);
    }

    public function updateStatus(Request $request, $id)
    {
        $label = Label::findOrFail($id);

        $label->package_status_id = $request->package_status_id;

        $label->save();

        return back();
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

    public function apiGetMyLabels()
    {

    }

    public function apiStoreMyLabel()
    {

    }

    public function apiUpdateStatus()
    {

    }
}
