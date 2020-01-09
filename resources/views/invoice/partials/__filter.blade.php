<div class="row justify-content-end">
    <div class="col-8 mr-2">
        <div class="form-group row d-flex">
            <h6 class="pr-4 align-self-end col-3 text-right"><strong>Due Date</strong></h6>
            <div class="px-2 col">
                <input class="form-control" name="dueDateStartingIn" placeholder="Start date"
                       type="date">
            </div>
            <div class="px-2 col">
                <input class="form-control" name="dueDateEndingIn" placeholder="Ending date"
                       type="date">
            </div>
        </div>

        <div class="form-group row d-flex">
            <h6 class="pr-4 align-self-end col-3 text-right"><strong>Delivery Date</strong></h6>
            <div class="px-2 col">
                <input class="form-control" name="deliveryDateStartingIn" placeholder="Start date"
                       type="date">
            </div>
            <div class="px-2 col">
                <input class="form-control" name="deliveryDateEndingIn" placeholder="Ending date"
                       type="date">
            </div>
        </div>

        <div class="form-group row">
            <h6 class="pr-4 align-self-end col-3 text-right"><strong>Invoice Date</strong></h6>
            <div class="px-2 col">
                <input class="form-control" name="invoiceDateStartingIn" placeholder="Start date"
                       type="date">
            </div>
            <div class="px-2 col">
                <input class="form-control" name="invoiceDateEndingIn" placeholder="Ending date"
                       type="date">
            </div>
        </div>

        <div class="form-group row">
            <h6 class="pr-4 align-self-end col-3 text-right"><strong>Total</strong></h6>
            <div class="px-2 col">
                <input class="form-control" name="minPaid" placeholder="min"
                       type="number">
            </div>
            <div class="px-2 col">
                <input class="form-control" name="maxPaid" placeholder="max"
                       type="number">
            </div>
        </div>
    </div>

    <div class="col-3">
        <h6><strong>Status</strong></h6>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="statusDraft">
            <label class="form-check-label" for="statusDraft">
                {{__('Draft')}}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="statusSent">
            <label class="form-check-label" for="statusSent">
                {{__('Sent')}}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="statusPaid">
            <label class="form-check-label" for="statusPaid">
                {{__('Paid')}}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="statusOverdue">
            <label class="form-check-label" for="statusOverdue">
                {{__('Overdue')}}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="statusWriteOff">
            <label class="form-check-label" for="statusWriteOff">
                {{__('Write-off')}}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="statusCanceled">
            <label class="form-check-label" for="statusCanceled">
                {{__('Canceled')}}
            </label>
        </div>
    </div>
</div>

