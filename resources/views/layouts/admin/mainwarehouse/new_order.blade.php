@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="ri-home-4-line mr-1 float-left"></i>Products</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/admin/mainwarehouse') }}"><i class="ri-home-4-line mr-1 float-left"></i>Warehouse</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Order - Main Warehouse</li>
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
                        <h4 class="card-title mb-3">@if(empty($getProductData['id'])) <i class="fas fa-plus" > </i> {{ $title }}  @else <i class="fas fa-pen" > </i> {{ $title }}  @endif </h4>
                     </div>
                     
                  </div>
           
            <div class="card-body">

             <form method="POST"  @if(empty($getProductData['id'])) action="{{url('admin/add_new_order/')}}"  @else action="{{url('admin/add_new_order/'.$getProductData['id'])}}" @endif  name="newOrderForm" id="newOrderForm" enctype="multipart/form-data">@csrf
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                          <label for="productCode">Product Code</label>
                          <input type="text" class="form-control" id="productCode" name="productCode" placeholder="Enter Product Name" @if(!empty($getProductData['product_code'])) value="{{$getProductData['product_code']}}" @else value="{{old('product_code')}}" @endif disabled>
                          <div class="help-block with-errors"></div>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                        <div class="form-group">
                          <label for="qtyRemainingCTNS">Quantity Remaining in Cartons</label>
                          <input type="text" class="form-control" id="qtyRemainingCTNS" name="qtyRemainingCTNS" placeholder="Quantity Remaining in ctns" @if(!empty($getProductData['newprod_qtyctn'])) value="{{$getProductData['newprod_qtyctn']}}" @else value="{{old('newprod_qtyctn')}}" @endif disabled>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>                                  
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                          <label for="mainwarehouseProductName">Product Name</label>
                          <input type="text" class="form-control" id="mainwarehouseProductName" name="mainwarehouseProductName" placeholder="Enter Product Name" @if(!empty($getProductData['main_product_name'])) value="{{$getProductData['main_product_name']}}" @else value="{{old('main_product_name')}}" @endif disabled>
                          <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                              <label for="qtyRemainingPCS">Quantity Remaining in PCS</label>
                              <input type="text" class="form-control" id="qtyRemainingPCS" name="qtyRemainingPCS" placeholder="Quantity Remaining in pcs"" @if(!empty($getProductData['total_prodqtypcs'])) value="{{$getProductData['total_prodqtypcs']}}" @else value="{{old('total_prodqtypcs')}}" @endif disabled>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="qtyctns">Current Quantity in Carton(pcs)</label>
                            <input type="text" class="form-control" id="qtyctns" name="qtyctns" placeholder="Enter Current Quantity in Cartons" @if(!empty($getProductData['qtybox'])) value="{{$getProductData['qtybox']}}" @else value="{{old('qtybox')}}" @endif disabled>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="qtyOrdered">New Quantity Ordered in Ctns/Cylns</label>
                            <input type="text" class="form-control" id="qtyOrdered" name="qtyOrdered" placeholder="Enter New Quantity Ordered" >
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="numberQtyCtns">New Quantity in Carton(pcs)</label>
                            <input type="text" class="form-control" id="numberQtyCtns" name="numberQtyCtns" placeholder="Enter New Quantity in Cartons(pcs)">
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="additionalQty">Additional Quantity (pcs) If Any (Optional)</label>
                            <input type="text" class="form-control" id="additionalQty" name="additionalQty" placeholder="Enter Additional Quantity (pcs) - Optional" >
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