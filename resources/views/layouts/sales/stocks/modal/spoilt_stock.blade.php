   
<!-- Add Spoilt Goods -->
<div class="modal fade" id="addSpoiltGoods" tabindex="-1" role="dialog" aria-labelledby="addSpoiltGoods" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="addSpoiltGoods"><i class="fas fa-times text-blue"></i> REMOVE SPOILT GOODS FROM SHOP</h6>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #ff0000;">×</span>
                </button>
            </div>

            <form action="{{ url('sales/addspoilt/' ) }}" method="post">@csrf

                <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                    <div class="col-12">
                        <label class="" for="productid">Product Name</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control select2" name="productid" id="productid" style="width:100%">
                                <option value="">*** Select Product ***</option>
                                @foreach($getproducts as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="" for="qtyspoiltpcs">Qty Expired</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="qtyspoiltpcs" name="qtyspoiltpcs" autocomplete="off" placeholder="Enter Quantity Expired" />
                        </div>
                    </div>
                    

                    <div class="col-12">
                        <label class="" for="prodcondition">Product Condition</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control" name="prodcondition" id="prodcondition">
                                <option value="">*** Select Product Condition ***</option>
                                <option value="Spoilt, not useful"> Spoilt, not useful</option>
                               
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-12">
                        <label class="" for="description">Brief Description</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control" id="description" name="description">

                                <option value="">*** Select Description ***</option>

                                <option value="Goods has expired and not useful"> Goods has expired and not useful </option>
                                <option value="Some tablets are missing"> Some tablets are missing </option>
                                <option value="Close to expiring"> Close to expiring </option>
                                   
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