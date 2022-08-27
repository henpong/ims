@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}"><i class="ri-home-4-line mr-1 float-left"></i>Categories</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="ri-home-4-line mr-1 float-left"></i>Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Products In Branches</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">
                <!-- Display Error Messages In a Loop -->
                @if ($errors->any())
                  <div class="alert bg-danger" style="margin-top:10px;">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                 @endif

                  <!-- Display Error Message -->
                  @if(Session::has('error_message'))
                    <div class="alert text-white bg-danger" role="alert">
                      <div class="iq-alert-icon">
                          <i class="ri-information-line"></i>
                      </div>
                      <div class="iq-alert-text">
                        {{Session::get('error_message')}}
                      </div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="ri-close-line"></i>
                      </button>
                    </div>
                  @endif

                  <!-- Display Success Message -->
                  @if(Session::has('success_message'))
                      <div class="alert text-white bg-success" role="alert">
                        <div class="iq-alert-icon">
                           <i class="ri-alert-line"></i>
                        </div>
                        <div class="iq-alert-text">
                          {{Session::get('success_message')}}
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                        </button>
                      </div>
                  @endif

                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title mb-3">@if(empty($getProductsData['id'])) <i class="fas fa-plus" > </i> {{ $title }}  @else <i class="fas fa-pen" > </i> {{ $title }}  @endif</h4>
                     </div>
                     
                  </div>
           
            <div class="card-body">

             <form method="POST"  @if(empty($getProductsData['id'])) action="{{url('admin/add_edit_products_in_branches')}}"  @else  action="{{url('admin/add_edit_products_in_branches/'.$getProductsData['id'])}}"  @endif name="productForm" id="productForm" enctype="multipart/form-data">@csrf
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label> Product Name</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="product_id" id="product_id" style="width:100%">
                              <option value="" >Select Product</option>
                              @foreach($mainwarehouseProduct as $prod) 
                                <option value="{{ $prod->id }}"  @if(isset($getProductsData['main_warehouse_id']) && $getProductsData['main_warehouse_id'] == $prod->id) selected @endif  >{{ $prod->main_product_name }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                        <div class="form-group">
                        <label for="wholeQTY">Wholesale Qty (pcs)</label>
                          <input type="text" class="form-control" id="wholeQTY" name="wholeQTY" placeholder="Enter Wholesale Qty" @if(!empty($getProductsData['wholesale_qty'])) value="{{$getProductsData['wholesale_qty']}}" @else value="{{old('wholesale_qty')}}" @endif >
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>                                  
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label> Branch Name</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="branch_id" id="branch_id" style="width:100%">
                              <option value="" >Select Branch</option>
                              @foreach($branches as $branch)
                              <option value="{{ $branch->id }}" @if(isset($getProductsData['branch_id']) && $getProductsData['branch_id'] == $branch->id) selected @endif >{{ $branch->branch_name }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="wholePrice">Wholesale Price(GHC)</label>
                              <input type="text" class="form-control" id="wholePrice" name="wholePrice" placeholder="Enter Wholesale Price(GHC)" @if(!empty($getProductsData['product_wholesale_price'])) value="{{$getProductsData['product_wholesale_price']}}" @else value="{{old('product_wholesale_price')}}" @endif>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="categoryDiscount">Unit Price (GHC)</label>
                            <input type="text" class="form-control" id="unitPrice" name="unitPrice" placeholder="Enter Unit Price (GHC)" @if(!empty($getProductsData['product_price'])) value="{{$getProductsData['product_price']}}" @else value="{{old('product_price')}}" @endif>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="branchAddress">Set Low Stock Point</label>
                            <input type="text" class="form-control" id="lowStock" name="lowStock" placeholder="Enter Low Stock Point" @if(!empty($getProductsData['lowstock_point'])) value="{{$getProductsData['lowstock_point']}}" @else value="{{old('lowstock_point')}}" @endif>
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