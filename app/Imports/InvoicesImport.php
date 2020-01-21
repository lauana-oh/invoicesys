<?php

namespace App\Imports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class InvoicesImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;
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
    
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required | exists:companies,id',
            'vendor_id' => 'required | exists:companies,id',
            'invoice_date' => 'required | date',
            'delivery_date' => 'required | date | after_or_equal:invoice_date',
            'due_date' => 'required | date | after_or_equal:delivery_date',
            'status_id' => 'required | exists:statuses,id',
        ];
    }
    
    /**
     * @inheritDoc
     */
    public function onFailure(Failure ...$failures)
    {
        // TODO: Implement onFailure() method.
    }
}
