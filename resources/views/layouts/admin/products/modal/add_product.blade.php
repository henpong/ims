

<div class="modal fade add-product" id="AddProduct"  data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="fas fa-plus" > </i> Add New Product In Various Branches </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#ff0000">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('admin/add_edit_products_in_branches') }}" name="productForm" id="productForm" enctype="multipart/form-data">@csrf
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="productName">Product Name</label><br>
                            <select class="form-control selectpicker select2"  name="product_id" id="product_id" style="width:100%">
                                <option value="" >*** Select Product ***</option>
                                @foreach($mainwarehouseproduct as $prod) 
                                    <option value="{{ $prod->id }}" >{{ $prod->main_product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="wholeQTY">Wholesale Qty (pcs)</label>
                                <input type="text" class="form-control" id="wholeQTY" name="wholeQTY" placeholder="Enter Wholesale Qty" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                  
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="branchName"> Branch Name</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="branch_id" id="branch_id" style="width:100%">
                                <option value="" >*** Select Branch ***</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" >{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="wholePrice">Wholesale Price(GHC)</label>
                            <input type="text" class="form-control" id="wholePrice" name="wholePrice" placeholder="Enter Wholesale Price (GHC)" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="categoryDiscount">Unit Price (GHC)</label>
                            <input type="text" class="form-control" id="unitPrice" name="unitPrice" placeholder="Enter Unit Price (GHC)" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                        <label for="branchAddress">Set Low Stock Point</label>
                        <input type="text" class="form-control" id="lowStock" name="lowStock" placeholder="Enter Low Stock Point" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                </div> 
        </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger mr-10"><i class="fas fa-sync"></i>Reset</button>
                <button type="button" class="btn btn-secondary mr-10" data-dismiss="modal"> <i class="fas fa-times"> </i> Close</button>
                <button type="submit" class="btn btn-primary"> <i class="fas fa-paper-plane"> </i> Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>