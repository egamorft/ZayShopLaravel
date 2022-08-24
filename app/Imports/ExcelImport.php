<?php

namespace App\Imports;

use App\Order;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Order([
            'account_id' => $row[0],
            'shipping_id' => $row[1],
            'order_status' => $row[2],
            'order_code' => $row[3],
            'created_at' => $row[4]
        ]);
    }
}
