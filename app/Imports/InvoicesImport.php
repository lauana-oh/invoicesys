<?php

namespace App\Imports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;

class InvoicesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Invoice([
            'client_id' => $row[1],
            'vendor_id' => $row[2],
            'invoice_date' => $row[3],
            'delivery_date' => $row[4],
            'due_date' => $row[5],
            'status_id' => $row[6]
        ]);
    }
}
