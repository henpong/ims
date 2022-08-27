
<?php

    use App\Models\Categories;
    use App\Models\Suppliers;
    use App\Models\Brand;
    use App\Models\Unit;
    use App\Models\Warehouse;

    $getCategories = Categories::getcategories();
    $getSupplier = Suppliers::getsuppliers();
    $getWarehouse = Warehouse::getwarehouse();
    $getBrand = Brand::getbrands();
    $getUnit = Unit::getunits();


?>

<div class="modal fade" id="AddWarehouseProduct"  data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="fas fa-plus" > </i> Add New Product In Warehouse </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#ff0000">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('admin/add_edit_mainwarehouse') }}" name="productForm" id="productForm" enctype="multipart/form-data">@csrf
                <div class="row">  
                    <div class="col-sm-6">  
                        <!-- Set User Id As Hidden -->
                        <input type="hidden" class="form-control" id="adminId" name="adminId"  value="{{Auth::guard('admin')->user()->id}}">
                                  
                        <div class="form-group">
                            <label for="mainwarehouseProductName">Product Name</label>
                                <input type="text" class="form-control" id="mainwarehouseProductName" name="mainwarehouseProductName" placeholder="Enter Product Name" @if(!empty($getMainWarehouseData['main_product_name'])) value="{{$getMainWarehouseData['main_product_name']}}" @else value="{{old('main_product_name')}}" @endif autocomplete="off">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label> Category </label>
                                <select class="form-control selectpicker select2" data-style="py-0" name="category_id" id="category_id" style="width: 100%;">
                                <option  value="" >*** Select Category ***</option>
                                    @foreach($getCategories as $category)
                                        <option value="{{ $category->id }}" @if(isset($getMainWarehouseData['category_id']) && $getMainWarehouseData['category_id'] == $category->id) selected @endif>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                  
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                        <label> Suppliers</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="supplier_id" id="supplier_id" style="width: 100%;">
                                <option  value="">*** Select Supplier ***</option>
                                @foreach($getSupplier as $supply)
                                    <option value="{{ $supply->id }}" @if(isset($getMainWarehouseData['supplier_id']) && $getMainWarehouseData['supplier_id'] == $supply->id) selected @endif>{{ $supply->supplier_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="lowstockPoint">Set Low Stock Point</label>
                                <input type="text" class="form-control" id="lowstockPoint" name="lowstockPoint" placeholder="Enter Value to Set Low Stock" @if(!empty($getMainWarehouseData['lowstock_point'])) value="{{$getMainWarehouseData['lowstock_point']}}" @else value="{{old('lowstock_point')}}" @endif autocomplete="off">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="qtyctns">Qty in ctns/pack(pcs)</label>
                                <input type="text" class="form-control" id="qtyctns" name="qtyctns" placeholder="Enter Quantity in Cartons" @if(!empty($getMainWarehouseData['qtybox'])) value="{{$getMainWarehouseData['qtybox']}}" @else value="{{old('qtybox')}}" @endif autocomplete="off">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="dateAdded">Date Added</label>
                                <input type="text" class="form-control datepicker" data-provide="datepicker" id="datepicker" name="dateAdded" placeholder="Select Date" @if(!empty($getMainWarehouseData['newprod_date'])) value="{{$getMainWarehouseData['newprod_date']}}" @else value="{{old('newprod_date')}}" @endif autocomplete="off">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label> Warehouse</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="warehouse" id="warehouse" style="width: 100%;">
                                <option  value="">*** Select Warehouse ***</option>
                                @foreach($getWarehouse as $warehouse)
                                    <option value="{{ $warehouse->id }}" @if(isset($getMainWarehouseData['warehouse']) && $getMainWarehouseData['warehouse'] == $warehouse->id) selected @endif> {{ $warehouse->name }} </option>
                                @endforeach 
                            </select>
                        </div>
                    </div>                                       
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label>Product Brand</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="brand_id" id="brand_id" style="width: 100%;">
                                <option  value="">*** Select Product Brand ***</option>
                                @foreach($getBrand as $brand)
                                    <option value="{{ $brand->id }}" @if(isset($getMainWarehouseData['brand_id']) && $getMainWarehouseData['brand_id'] == $brand->id) selected @endif> {{ $brand->brand_name }} </option>
                                @endforeach 
                            </select>
                        </div>
                    </div>                                       
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label> Product Unit</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="unit_id" id="unit_id" style="width: 100%;">
                                <option  value="">*** Select Product Unit ***</option>
                                @foreach($getUnit as $unit)
                                    <option value="{{ $unit->id }}" @if(isset($getMainWarehouseData['unit_id']) && $getMainWarehouseData['unit_id'] == $unit->id) selected @endif> {{ $unit->unit_name }} </option>
                                @endforeach 
                            </select>
                        </div>
                    </div>                                       
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="prodcost">Product Cost (GHC)</label>
                                <input type="text" class="form-control" id="prodcost" name="prodcost" placeholder="Enter Product Cost" @if(!empty($getMainWarehouseData['prodcost'])) value="{{$getMainWarehouseData['prodcost']}}" @else value="{{old('prodcost')}}" @endif autocomplete="off">
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