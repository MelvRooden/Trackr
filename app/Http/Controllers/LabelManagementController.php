<?php

namespace App\Http\Controllers;

use App\Business\LabelPdfLogic;
use App\Http\Requests\Label\SetPickupRequest;
use App\Http\Requests\Label\StateChangeRequest;
use App\Http\Requests\Label\StoreCsvRequest;
use App\Http\Requests\Label\StoreRequest;
use App\Http\Resources\LabelResource;
use App\Imports\LabelImportCsv;
use App\Models\Label;
use App\Models\PackageStatus;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LabelManagementController extends Controller
{
    /**
     * @param int $search_ps_id
     * @param $search_param
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(int $search_ps_id = 1, $search_param = null)
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
            $labels = Label::search($search_param)->get();
                if (!$labels->isEmpty())
                {
                    $labels = $labels->toQuery()
                        ->where('package_status_id', $search_ps_id)
                        ->where('sender_user_id', $user_id)
                        ->orWhere('carrier_user_id', $user_id)
                        ->orWhere('receiver_user_id', $user_id)
                        ->orderBy('carrier_user_id', 'ASC')
                        ->paginate(5);
                } else {
                    $labels = Label::where('barcode_id', '')->paginate(5);
                }
        } else {
            $labels = Label::where('sender_user_id', $user_id)
                ->where('package_status_id', $search_ps_id)
                ->orWhere('carrier_user_id', $user_id)
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
     * @param StoreCsvRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCSVFile(StoreCsvRequest $request)
    {
        $label = Label::generateLabelCode();
        $packageStatus = PackageStatus::findOrFail(1)->get();

        if ($label != null && $packageStatus != null) {
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
        $user_id = Auth::id();

        if (Auth::user()->can('viewAny', User::class)) {
            $labels = Label::orderBy('carrier_user_id', 'ASC');
        } else if (Auth::user()->can('create', Label::class)) {
            $labels = Label::where('sender_user_id', $user_id)
                ->orWhere('carrier_user_id', $user_id)
                ->orderBy('carrier_user_id', 'ASC');
        } else {
            return back();
        }

        $logic = new LabelPdfLogic($labels->get()->all());

        return $logic->createLabelPdf();
    }

    public function getPickups()
    {
        $search_ps_id = 5;
        $user_id = Auth::id();

        if (Auth::user()->can('viewAny', User::class)) {
            $labels = Label::where('package_status_id', $search_ps_id)
                ->orderBy('pickup_datetime', 'ASC')
                ->paginate(5);
        } else {
            $labels = Label::where('sender_user_id', $user_id)
                ->where('package_status_id', $search_ps_id)
                ->orWhere('carrier_user_id', $user_id)
                ->orWhere('receiver_user_id', $user_id)
                ->orderBy('pickup_datetime', 'ASC')
                ->paginate(5);
        }

        return view('pickupManagement.index', ['labels' => $labels]);
    }

    public function setForPickup(SetPickupRequest $request, $id)
    {
        $label = Label::find($id);

        if ($label == null)
        {
            return back()->with('messages.error', 'attributes.label.error.addedPickup');
        }

        $label->package_status_id = 5;
        $label->pickup_datetime = $request->validated('pickup_datetime');
        $label->pickup_address = $request->validated('pickup_address');
        $label->pickup_city = $request->validated('pickup_city');
        $label->pickup_postcode = $request->validated('pickup_postcodes');

        $label->save();

        return back()->with('messages.success', 'attributes.label.success.addedPickup');
    }

    /**
     * @return void
     */
    public function apiStoreMyLabel(StoreRequest $request) : View|Factory|LabelResource|Application
    {
        $user = $request->user();
        $carrier_id = User::where('name', $request->validated("carrier_name"))->first()->id;

        $labelData = array_merge($request->validated(), [
            'barcode_id' => Label::generateLabelCode(),
            'package_status_id' => 1,
            'carrier_user_id' => $carrier_id,
            'sender_user_id' => $user->id,
            'sender_address' => $user->address,
            'sender_city' => $user->city,
            'sender_postcode' => $user->postcode
        ]);

        $label = Label::create($labelData);

        if ($request->expectsJson())
        {
            return new LabelResource($label);
        }
    }

    /**
     * @return void
     */
    public function apiMyLabelStatus(StateChangeRequest $request)
    {
        $status_id = PackageStatus::where('name', $request->validated("package_status"))->first()->id;
        $label = Label::where('barcode_id', $request->validated("barcode_id"))->first();

        $label->package_status_id = $status_id;

        $label->save();

        return $label;
    }
}
