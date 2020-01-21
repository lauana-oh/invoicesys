<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Invoice::all();
    }
    
    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            'id',
            'client_id',
            'vendor_id',
            'invoice_date',
            'delivery_date',
            'due_date',
            'status_id',
            'created_at',
            'updated_at',
        ];
    }
}
