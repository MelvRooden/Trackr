<?php

namespace App\Http\Controllers;

use App\Business\LabelPdfLogic;
use App\Http\Requests\Label\StoreCsvRequest;
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
     * @param $search_ps_id
     * @param $search_param
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($search_ps_id = 1, $search_param = null)
    {
        $user_id = Auth::id();
        $package_statuses = PackageStatus::All();

        if (Auth::user()->can('viewAny', User::class)) {
            if ($search_param) {
                $labels = Label::search($search_param)
                    ->where('package_status_id', $search_ps_id)
                    ->orderBy('carrier_user_id', 'ASC')
                    ->paginate(5);
            } else {
                $labels = Label::where('package_status_id', $search_ps_id)
                    ->orderBy('carrier_user_id', 'ASC')
                    ->paginate(5);
            }
        } else if ($search_param) {
            $labels = Label::search($search_param)
                ->where('package_status_id', $search_ps_id)
                ->where('carrier_user_id', $user_id)
                ->orWhere('sender_user_id', $user_id)
                ->orWhere('receiver_user_id',$user_id)
                ->orderBy('carrier_user_id', 'ASC')
                ->paginate(5);
        } else {
            $labels = Label::where('carrier_user_id', $user_id)
                ->where('package_status_id', $search_ps_id)
                ->orWhere('sender_user_id', $user_id)
                ->orWhere('receiver_user_id', $user_id)
                ->orderBy('carrier_user_id', 'ASC')
                ->paginate(5);
        }

        return view('labelManagement.index', ['labels' => $labels, 'package_statuses' => $package_statuses]);
    }

    /**
     * @param $barCode_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showByBar($barCode_id = null)
    {
        $labels = Label::where('barCode_id', $barCode_id)->get();

        return view('labelManagement.showByBar', ['labels' => $labels]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    public function labelPdf($label_id)
    {
        $label = Label::findOrFail($label_id);

        $logic = new LabelPdfLogic([$label]);

        return $logic->createLabelPdf();
    }

    public function labelPdfBulk()
    {
        $authRole = Auth::user()->role_id;

        if ($authRole == 1) {
            $labels = Label::where('package_status_id', 1)
                ->orderBy('carrier_user_id', 'ASC');
        } else if ($authRole == 2) {
            $labels = Label::where('sender_user_id', Auth::id())
                ->where('package_status_id', 1)
                ->orderBy('carrier_user_id', 'ASC');
        } else if ($authRole == 3) {
            $labels = Label::where('carrier_user_id', Auth::id())
                ->where('package_status_id', 1)
                ->orderBy('carrier_user_id', 'ASC');
        } else {
            return back();
        }

        $logic = new LabelPdfLogic($labels->all());

        return $logic->createLabelPdf();
    }

    /**
     * @return void
     */
    public function apiGetMyLabels()
    {

    }

    /**
     * @return void
     */
    public function apiStoreMyLabel()
    {

    }

    /**
     * @return void
     */
    public function apiUpdateStatus()
    {

    }
}
