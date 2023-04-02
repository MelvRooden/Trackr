<?php

namespace App\Imports;

use App\Models\Label;
use App\Models\PackageStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class LabelImportCsv implements ToModel
{
    /**
     * @param array $row
     *
     * @return Model|Label|null
     */
    public function model(array $row): Model|Label|null
    {
        $barcode = Label::generateLabelCode();

        error_log('ID_C: ' . $row[0]);


        $carrier = User::where('role_id', 3)->where('name', $row[0])->first();
        $sender_id = User::where('role_id', 2)->where('name', $row[1])->first();

        error_log('ID_C: ' . $carrier->id);
        error_log('ID_S: ' . $sender_id->id);


        error_log('carrier_user_id: ' . $row[0]);

        error_log('sender_user_id: ' . $row[1]);
        error_log('sender_address: ' . $row[2]);
        error_log('sender_postcode: ' . $row[3]);
        error_log('sender_city: ' . $row[4]);

        error_log('receiver_address: ' . $row[6]);
        error_log('receiver_postcode: ' . $row[7]);
        error_log('receiver_city: ' . $row[8]);

        if ($barcode != null) {
            $label = new Label([
                'barcode_id' => $barcode,
                'package_status_id' => 1,
                'carrier_user_id' => $carrier->id,

                'sender_user_id' => $sender_id->id,
                'sender_address' => $row[2],
                'sender_postcode' => $row[3],
                'sender_city' => $row[4],

//                'receiver_user_id' => $row[5],
                'receiver_address' => $row[6],
                'receiver_postcode' => $row[7],
                'receiver_city' => $row[8]
            ]);

            error_log('Label made');

            return $label;
        } else {
            return null;
        }
    }
}
