  <!-- Add Stock -->
  <div class="modal fade" id="addStock" tabindex="-1" role="dialog" aria-labelledby="addStock" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStock"><i class="fas fa-plus text-blue"></i> ADD NEW STOCK (S)</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #ff0000;">×</span>
                </button>
            </div>

            <form action="{{ url('sales/addstock/' ) }}" method="post">@csrf

                <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                    <div class="col-12">
                        <label class="" for="productid">Product Name</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control select2" name="productid" id="productids">
                                <option value="">*** Select Product ***</option>
                                @foreach($getlowproducts as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->product_name . " =======> ". " Available Qty (". $prod->product_qty .")"}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="" for="qtyctn">Qty (CTNS)</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="qtyctn" name="qtyctn" autocomplete="off" placeholder="Enter Quantity (CTNS)" />
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="" for="qtypcs">Qty (PCS)</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="qtypcs" name="qtypcs" autocomplete="off" placeholder="Enter Quantity (PCS)" />
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                        <i class="fas fa-times text-white fa-spin"> </i> &nbsp;&nbsp;
                        Cancel
                    </button>
                    <button class="btn btn-sm btn-primary" type="submit" >
                        <i class="fas fa-paper-plane text-white"> </i> &nbsp;&nbsp;
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add Stock -->