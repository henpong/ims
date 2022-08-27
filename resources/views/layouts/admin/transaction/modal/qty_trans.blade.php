
<!-- Update Qty Transaction Detail -->
<div class="modal fade" id="updateQty{{ $trans->id }}" tabindex="-1" role="dialog" aria-labelledby="updateQty" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="updateQty"><i class="far fa-edit text-blue"></i> Change Product Qty (pcs)</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: #ff0000;">×</span>
        </button>
        </div>

        <form action="{{ url('sales/update_qty_transaction/'.$insertid ) }}" method="post">@csrf
            <div class="modal-body m-3">
                <input type="hidden" class="form-control" name="insertid" value="{{ $insertid }}" required>
                <input type="hidden" class="form-control" id="id" name="id" value="{{ $trans->id }}" required> 
                <input type="hidden" class="form-control" id="productid" name="productid" value="{{ $trans->product->id }}" required> 

                <div class="col-12">
                    <label class="" for="qtypcs">Product Name</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" class="form-control" id="qtypcs"  value="{{ $trans->product->product_name }}"  disabled style="font-size:15px;font-weight:bolder" autocomplete="off"/>
                    </div>
                </div>

                <div class="col-12">
                    <label class="" for="qtypcs">Quantity (PCS)</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" class="form-control" id="qtypcs" name="qtypcs" value="{{ $trans->qty }}" autocomplete="off" placeholder="Quantity (PCS)" />
                    </div>
                </div>

                <!-- <div class="col-12">
                    <label class="" for="discount">Discount (GHC)</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" class="form-control" id="discount" name="discount" autocomplete="off" placeholder="0.00" />
                    </div>
                </div> -->

            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-danger mt-2" type="button" data-dismiss="modal">
                    <i class="fas fa-times text-red"> </i> &nbsp;&nbsp;
                    Go Back
                </button>
                <button class="btn btn-primary" type="submit" >
                    <i class="fas fa-paper-plane text-white"> </i> &nbsp;&nbsp;
                    Update
                </button>
            </div>
        </form>
    </div>
    </div>
</div>
<!-- Update Qty Transaction Detail -->