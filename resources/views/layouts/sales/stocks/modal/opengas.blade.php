


  <!-- Add Gas -->
  <div class="modal fade" id="openGas{{ $gas->id }}" tabindex="-1" role="dialog" aria-labelledby="addGas" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openGas"><i class="fas fa-plus text-blue"></i> OPEN NEW GAS POUND(S)</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #ff0000;">×</span>
                </button>
            </div>

            <form action="{{ url('sales/open_new_gas/'.$gas->id )}}" method="post">@csrf

                <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                    <input type="hidden" class="form-control" id="pdsid" name="pdsid"  value="{{ $gas->id }}"/>

                    <div class="col-12">
                        <label class="" for="productid">Product Name</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="pdsname" name="pdsname"  value="{{ $gas->gas_pds_name }}" disabled/>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="" for="qtypcs">Qty (Opened)</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="pdsqty" name="pdsqty" autocomplete="off" placeholder="Enter Quantity (PCS)" required="true"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="" for="qtypcs">Weight (Kg)</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="pdsweight" name="pdsweight" autocomplete="off" placeholder="Enter Weight (Kg)" required="true"/>
                        </div>
                        <span style="color:#ff0000"><small>Please enter weight for only one cylinder</small></span>
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
<!-- End of Add Gas -->