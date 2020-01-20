<div class="row justify-content-end">
    <div class="col-8 mr-2">
        <div class="form-group row d-flex">
            <h6 class="pr-4 align-self-end col-3 text-right"><strong>{{__('Due Date')}}</strong></h6>
            <div class="px-2 col">
                <input class="form-control" name="filter[due_date_starts_after]" placeholder="Start date"
                       type="date" value="{{ request()->input('filter.due_date_starts_after') }}">
            </div>
            <div class="px-2 col">
                <input class="form-control" name="filter[due_date_ends_before]" placeholder="Ending date"
                       type="date" value="{{ request()->input('filter.due_date_ends_before') }}">
            </div>
        </div>

        <div class="form-group row d-flex">
            <h6 class="pr-4 align-self-end col-3 text-right"><strong>{{__('Delivery Date')}}</strong></h6>
            <div class="px-2 col">
                <input class="form-control" name="filter[delivery_date_starts_after]" placeholder="Start date"
                       type="date" value="{{ request()->input('filter.delivery_date_starts_after') }}">
            </div>
            <div class="px-2 col">
                <input class="form-control" name="filter[delivery_date_ends_before]" placeholder="Ending date"
                       type="date" value="{{ request()->input('filter.delivery_date_ends_before') }}">
            </div>
        </div>

        <div class="form-group row">
            <h6 class="pr-4 align-self-end col-3 text-right"><strong>{{__('Invoice Date')}}</strong></h6>
            <div class="px-2 col">
                <input class="form-control" name="filter[invoice_date_starts_after]" placeholder="Start date"
                       type="date" value="{{ request()->input('filter.invoice_date_starts_after') }}">
            </div>
            <div class="px-2 col">
                <input class="form-control" name="filter[invoice_date_ends_before]" placeholder="Ending date"
                       type="date" value="{{ request()->input('filter.invoice_date_ends_after') }}">
            </div>
        </div>

        <div class="form-group row">
            <h6 class="pr-4 align-self-end col-3 text-right"><strong>{{__('Total')}}</strong></h6>
            <div class="px-2 col">
                <input class="form-control" name="filter[invoice_min_total]" placeholder="min" type="number"
                       value="{{ request()->input('filter.invoice_min_total') }}">
            </div>
            <div class="px-2 col">
                <input class="form-control" name="filter[invoice_max_total]" placeholder="max" type="number"
                       value="{{ request()->input('filter.invoice_max_total') }}">
            </div>
        </div>
    </div>

    <div class="col-3">
        <h6><strong>{{__('Status')}}</strong></h6>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="filter[status_filter][1]" value="draft" id="statusDraft">
            <label class="form-check-label" for="statusDraft">
                {{__('Draft')}}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="filter[status_filter][2]" value="sent" id="statusSent">
            <label class="form-check-label" for="statusSent">
                {{__('Sent')}}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox"  name="filter[status_filter][3]" value="paid" id="statusPaid">
            <label class="form-check-label" for="statusPaid">
                {{__('Paid')}}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox"  name="filter[status_filter][4]" value="overdue" id="statusOverdue">
            <label class="form-check-label" for="statusOverdue">
                {{__('Overdue')}}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox"  name="filter[status_filter][5]" value="write-off" id="statusWriteOff">
            <label class="form-check-label" for="statusWriteOff">
                {{__('Write-off')}}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox"  name="filter[status_filter][6]" value="cancelled" id="statusCancelled">
            <label class="form-check-label" for="statusCancelled">
                {{__('Canceled')}}
            </label>
        </div>
    </div>
</div>

