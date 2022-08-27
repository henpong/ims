
<!-- Add Returned Goods -->
<div class="modal fade" id="addReturnedGoods" tabindex="-1" role="dialog" aria-labelledby="addReturnedGoods" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReturnedGoods"><i class="fas fa-plus text-blue"></i> ADD RETURNED DRUG(S)</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #ff0000;">×</span>
                </button>
            </div>

            <form action="{{ url('sales/addreturned/' ) }}" method="post">@csrf

                <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                    <div class="col-12">
                        <label class="" for="productid">Drug Name</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control" name="productid" id="productid" style="width:100%">
                                <option value="">*** Select Product ***</option>
                                @foreach($getproducts as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="" for="qtyreturnedpcs">Qty Returned</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="qtyreturnedpcs" name="qtyreturnedpcs" autocomplete="off" placeholder="Enter Quantity Returned" />
                        </div>
                    </div>
                    

                    <div class="col-12">
                        <label class="" for="prodcondition">Product Condition</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control" name="prodcondition" id="prodcondition">
                                <option value="">*** Select Product Condition ***</option>
                                <option value="Customer Returned">Customer Returned</option>
                               
                            </select>
                        </div>
                    </div>


                    <div class="col-12">
                        <label class="" for="custid">Receipt Number</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control custid select2" id="custid" name="custid" data-dependent="custname">
                                <option value="">*** Select Receipt Number ***</option>
                                    @foreach($getreceipt as $receipt)
                                        <option value="{{ $receipt->id }}">{{ $receipt->or_no }}</option>
                                    @endforeach
                               
                            </select>
                        </div>
                    </div> 


                    <div class="col-12">
                        <label class="" for="custname">Customer's Name</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control" id="custname" >
                                <option value="">*** Select Customer's Name ***</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-12">
                        <label class="" for="description">Brief Description</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control" id="description" name="description">

                                <option value="">*** Select Description ***</option>

                                <option value="Customer wanted different brand"> Customer wanted different brand </option>
                                <option value="Goods not effective"> Goods not effective </option>                                
                                <option value="Product has expired"> Product has expired </option>
                                   
                            </select>
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
<!-- End of Add Returned Goods -->