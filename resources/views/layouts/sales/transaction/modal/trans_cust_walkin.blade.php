    

<!-- Update Qty Transaction Detail -->
 <div class="modal fade" id="customerTrans" tabindex="-1" role="dialog" aria-labelledby="customerTrans" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="customerTrans"><i class="fas fa-users text-blue"></i> Customer Transaction</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: #ff0000;">×</span>
        </button>
        </div>

        <form action="{{ url('sales/transaction') }}" method="post">@csrf
                <div class="modal-body m-3">
            
                    <h6 class="card-subtitle " style="color: #ff0000;">Perform New Customer Transaction</h6>
                    <br>

                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control select2" name="fname" id="fname">
                                <option value="">*** Select Customer ***</option>
                                <option value="Walk-In-Customer">Walk-In-Customer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Customer's Phone Number" autocomplete="off">
                        </div>

                        <input type="hidden" class="form-control col-sm-9" name="address" id="address">
                        <input type="hidden" class="form-control col-sm-9" name="company" id="company" >

                </div>

                <div class="modal-footer">
                    <!-- <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                        <i class="fas fa-times text-white fa-spin"> </i> &nbsp;&nbsp;
                        No, Go Back
                    </button> -->
                    <button type="submit" class="btn btn-primary " >Next <i class="fas fa-arrow-right"></i> </button>
                </div>
        </form>
    </div>
    </div>
</div>
<!-- Update Qty Transaction Detail -->
    
    
 