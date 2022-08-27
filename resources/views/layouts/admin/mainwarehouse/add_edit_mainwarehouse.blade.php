@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="ri-home-4-line mr-1 float-left"></i>Products</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mainwarehouse') }}"><i class="ri-home-4-line mr-1 float-left"></i>Warehouse</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Products In Warehouse</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">
                <!-- Display Error Messages In a Loop -->
                @if ($errors->any())
                  <div class="alert alert-danger" style="margin:20px;width:40%;">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                 @endif
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title mb-3">@if(empty($getMainWarehouseData['id'])) <i class="fas fa-plus" > </i> {{ $title }}  @else <i class="fas fa-pen" > </i> {{ $title }}  @endif</h4>
                     </div>
                     
                  </div>
           
            <div class="card-body">

             <form method="POST"  @if(empty($getMainWarehouseData['id'])) action="{{url('admin/add_edit_mainwarehouse')}}" @else action="{{url('admin/add_edit_mainwarehouse/'.$getMainWarehouseData['id'])}}" @endif  name="mainwarehouseForm" id="mainwarehouseForm" enctype="multipart/form-data">@csrf
                  <div class="row"> 
                  <!-- Set User Id As Hidden -->
                  <input type="hidden" class="form-control" id="adminId" name="adminId"  value="{{Auth::guard('admin')->user()->id}}">
              
              
                      <div class="col-sm-6">                      
                          <div class="form-group"> 
                            <label for="mainwarehouseProductName">Product Name</label>
                            <input type="text" class="form-control" id="mainwarehouseProductName" name="mainwarehouseProductName" placeholder="Enter Product Name" @if(!empty($getMainWarehouseData['main_product_name'])) value="{{$getMainWarehouseData['main_product_name']}}" @else value="{{old('main_product_name')}}" @endif>
                            <div class="help-block with-errors"></div>
                            
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                        <div class="form-group">
                            <label> Product Category</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="category_id" id="category_id" style="width:100%">
                                <option  value="">Select Category</option>
                                @foreach($getCategories as $category)
                                  <option value="{{ $category->id }}" @if(isset($getMainWarehouseData['category_id']) && $getMainWarehouseData['category_id'] == $category->id) selected @endif>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>                                  
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label> Supplier</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="supplier_id" id="supplier_id" style="width:100%">
                                <option  value="">Select Supplier</option>
                                @foreach($getSupplier as $supply)
                                    <option value="{{ $supply->id }}" @if(isset($getMainWarehouseData['supplier_id']) && $getMainWarehouseData['supplier_id'] == $supply->id) selected @endif>{{ $supply->supplier_name }}</option>
                                @endforeach
                            </select>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                              <label for="lowstockPoint">Set Low Stock Point</label>
                              <input type="text" class="form-control" id="lowstockPoint" name="lowstockPoint" placeholder="Enter Value to Set Low Stock" @if(!empty($getMainWarehouseData['lowstock_point'])) value="{{$getMainWarehouseData['lowstock_point']}}" @else value="{{old('lowstock_point')}}" @endif>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                             <label for="qtyctns">Qty in ctns/pack(pcs)</label>
                             <input type="text" class="form-control" id="qtyctns" name="qtyctns" placeholder="Enter Quantity in Cartons" @if(!empty($getMainWarehouseData['qtybox'])) value="{{$getMainWarehouseData['qtybox']}}" @else value="{{old('qtybox')}}" @endif>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                     
                          <div class="form-group">
                            <label> Select Brand</label><br/>
                            <select class="form-control selectpicker select2" data-style="py-0" name="brand_id" id="brand_id" style="width:100%">
                                <option  value="">Select Brand</option>
                                @foreach($getBrands as $brand)
                                    <option value="{{ $brand->id }}" @if(isset($getMainWarehouseData['brand_id']) && $getMainWarehouseData['brand_id'] == $brand->id) selected @endif>{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                          </div>
                      </div>                                     
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label> Select Warehouse</label><br/>
                            <select class="form-control selectpicker select2" data-style="py-0" name="warehouse" id="warehouse" style="width:100%">
                                <option  value="">Select Warehouse</option>
                                <option value="1" @if(isset($getMainWarehouseData['warehouse'])) selected @endif> Main Warehouse </option>
                                <option value="2"> New Warehouse </option>
                            </select>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="prodcost">Product Cost (GHC)</label>
                            <input type="text" class="form-control" id="prodcost" name="prodcost" placeholder="Enter Amount (GHC)" @if(!empty($getMainWarehouseData['prodcost'])) value="{{$getMainWarehouseData['prodcost']}}" @else value="{{old('prodcost')}}" @endif autocomplete="off">
                            <div class="help-block with-errors"></div>
                          </div>
                      </div> 
                  </div> 
                  <button type="reset" class="btn btn-danger">Reset</button>                           
                  <button type="submit" class="btn btn-success mr-2" ><i class="fas fa-paper-plane"></i>Submit</button>
             </form>

            </div>
        
      </div>
    </div>
              

@endsection