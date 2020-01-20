<?php

namespace App\Imports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvoicesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Invoice([
            'client_id' => $row['client_id'],
            'vendor_id' => $row['vendor_id'],
            'invoice_date' => $row['invoice_date'],
            'delivery_date' => $row['delivery_date'],
            'due_date' => $row['due_date'],
            'status_id' => $row['status_id']
        ]);
    }
}
