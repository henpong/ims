    

<!-- Temporal Customer Transaction -->
<div class="modal fade" id="detailedTempCustomerTrans" tabindex="-1" role="dialog" aria-labelledby="detailedTempCustomerTrans" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="detailedTempCustomerTrans"><i class="fas fa-users text-blue"></i>Temporal Customer Transaction</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: #ff0000;">×</span>
        </button>
        </div>

        <form action="{{ url('sales/temp_transaction') }}" method="post">@csrf
                <div class="modal-body m-3">
            
                    <h6 class="card-subtitle " style="color: #ff0000;">Perform Temporal Customer Transaction</h6>
                    <br>

                    <div class="form-group">
                        <label for="fname">Full name:</label>
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter Customer's Full Name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Customer's Phone Number" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="address"> Company's Address</label>
                        <textarea class="form-control" placeholder="Enter Company's Address" rows="3" name="address" id="address"  autocomplete="off"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="company">Name of Company</label>
                        <input type="text" class="form-control" name="company" id="company" placeholder="Enter Company's Name" autocomplete="off">
                    </div>

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
    
    
 