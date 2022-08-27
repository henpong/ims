

<div class="modal fade update-product" id="UpdateProduct{{ $product->id }}"  data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="fas fa-pen" > </i> Update Product In Various Branches</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#ff0000">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('admin/update_products_in_branches/'.$product->id )}}" name="productForm" id="productForm" enctype="multipart/form-data">@csrf
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="product_id" id="product_id" >
                                <option value="" >Select Product</option>
                                @foreach($mainwarehouseproduct as $prod) 
                                    <option value="{{ $prod->id }}" >{{ $prod->main_product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="wholeQTY">Wholesale Qty (pcs)</label>
                                <input type="text" class="form-control" id="wholeQTY" name="wholeQTY" value="{{ $product->wholesale_qty }}" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                  
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label> Branch Name</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="branch_id" id="branch_id" >
                                <option value="" >Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" >{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="wholePrice">Wholesale Price(GHC)</label>
                            <input type="text" class="form-control" id="wholePrice" name="wholePrice" value="{{ number_format($product->product_wholesale_price,2) }}" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="categoryDiscount">Unit Price (GHC)</label>
                            <input type="text" class="form-control" id="unitPrice" name="unitPrice" value="{{ number_format($product->product_price,2) }}">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                        <label for="branchAddress">Set Low Stock Point</label>
                        <input type="text" class="form-control" id="lowStock" name="lowStock" value="{{ $product->lowstock_point }}" >
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                </div>          
            
        </div>
        <div class="modal-footer">
            <!-- <button type="reset" class="btn btn-danger mr-10">Reset</button>  -->
            <button type="button" class="btn btn-secondary mr-10" data-dismiss="modal"> <i class="fas fa-times"> </i> Close</button>
            <button type="submit" class="btn btn-primary"> <i class="fas fa-save"> </i> Save changes</button>
        </div>
        </form>
        </div>
    </div>
</div>