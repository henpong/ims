

<div class="modal fade show" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="printModalLabel">Re-Print Customer's Receipt ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:#ff0000;">&times;</span>
            </button>
        </div>
        <div class="modal-body">Do you want to re-print customer's receipt ?</div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal"> <i class="fas fa-times fa-sm fa-fw mr-2 text-gray-400"> </i> No</button>
                <!-- <a class="btn btn-primary" href="{{ url('/sales/re-print') }}"> <i class="fas fa-print fa-sm fa-fw mr-2 text-gray-400"> </i> Yes</a> -->
                <a data-toggle="modal" data-target="#reprintModal" data-backdrop="static" class="btn btn-primary"><i class="fas fa-print fa-sm fa-fw mr-2 text-gray-400"></i>Yes </a>
            </div>
        </div>
    </div>
</div>



<div class="modal fade show" id="reprintModal" tabindex="-1" role="dialog" aria-labelledby="reprintModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="reprintModalLabel">Re-Print Customer's Receipt ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:#ff0000;">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/sales/re_print') }}">@csrf

                <div class="col-12">
                    <label class="" for="receiptnom">Enter Receipt Number</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" class="form-control" id="receiptnom" name="receiptnom" placeholder="Enter Customer's Receipt Number" autocomplete="off" required/>
                    </div>
                </div>

                <div class="col-12">
                    <label class="" for="address">Select Date</label>
                    <div class="input-group mb-4" style="width:100%">
                        <div class="input-group p-0 shadow-sm" >
                            <input type="text" placeholder="Choose a transaction date" class="form-control" data-date-end-date="0d" id="transactionDate" name="transactionDate" autocomplete="off" required>
                            <div class="input-group-append"><span class="input-group-text px-4"><i class="fas fa-calendar-alt"></i></span></div>
                        </div>
                    </div>
                </div>

                
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" > <i class="fas fa-print fa-sm fa-fw mr-2 text-gray-400"> </i> Print</button>
                    <!-- <a class="btn btn-primary" href=""> <i class="fas fa-print fa-sm fa-fw mr-2 text-gray-400"> </i> Print</a> -->
                </div>
            </form>
        </div>
        </div>
    </div>
</div>