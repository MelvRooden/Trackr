<?php

namespace App\Imports;

use App\Models\Label;
use App\Models\PackageStatus;
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

        if ($barcode != null) {
            return new Label([
                'barcode_id' => $barcode,
                'package_status_id' => 1,
                'carrier_user_id' => $row[0],
                'sender_user_id' => $row[1],
                'sender_address' => $row[2],
                'sender_postcode' => $row[3],
                'sender_city' => $row[4],
                'receiver_user_id' => $row[5],
                'receiver_address' => $row[6],
                'receiver_postcode' => $row[7],
                'receiver_city' => $row[8]
            ]);
        } else {
            return null;
        }
    }
}
