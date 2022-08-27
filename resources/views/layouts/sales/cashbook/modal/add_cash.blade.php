 
 
 <!-- Add Cash -->
  <div class="modal fade" id="addCash" tabindex="-1" role="dialog" aria-labelledby="addCash" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCash"><i class="fas fa-plus text-blue"> </i> Enter Cash In Hand</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #ff0000;">×</span>
                </button>
            </div>

            <form action="{{ url('sales/addcash/' ) }}" method="post">@csrf

                <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                    <h5 style="text-align:center">Enter cash in hand for today's sales</h5>

                    <!-- <div class="col-12">
                        <label class="" for="productid">Description</label>
                        <div class="input-group mb-2 mr-sm-2">
                           <textarea class="form-control" name="description" id="description" cols="10" rows="5">

                           </textarea>
                        </div>
                    </div> -->

                    <div class="col-12">
                        <label class="" for="amount">Amount (GHC)</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="amount" name="amount" autocomplete="off" placeholder="Enter Amount (GHC)" />
                        </div>
                    </div>


            </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                        <i class="fas fa-times text-white fa-spin"> </i> &nbsp;
                        Cancel
                    </button>
                    <button class="btn btn-sm btn-primary" type="submit" >
                        <i class="fas fa-paper-plane text-white"> </i> &nbsp;
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Cash -->