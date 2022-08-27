@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/branches') }}"><i class="ri-home-8-line mr-1 float-left"></i>Branches</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/suppliers') }}"><i class="ri-user-4-line mr-1 float-left"></i>Suppliers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Suppliers</li>
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
                        <h4 class="card-title mb-3">@if(empty($getSupplierData['id'])) <i class="fas fa-plus" > </i> {{ $title }}  @else <i class="fas fa-user-plus" > </i> {{ $title }}  @endif</h4>
                     </div>
                     
                  </div>
           
            <div class="card-body">

             <form method="POST" @if(empty($getSupplierData['id'])) action="{{url('admin/add_edit_supplier')}}" @else action="{{url('admin/add_edit_supplier/'.$getSupplierData['id'])}}"  @endif  name="supplierForm" id="supplierForm" enctype="multipart/form-data">@csrf
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                              <label for="supplierName">Supplier Name</label>
                              <input type="text" class="form-control" id="supplierName" name="supplierName" placeholder="Enter Supplier Name" @if(!empty($getSupplierData['supplier_name'])) value="{{$getSupplierData['supplier_name']}}" @else value="{{old('supplier_name')}}" @endif>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label> Supplier Country</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="supplierCountry" id="supplierCountry" style="width: 100%;">
                              <option value="" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "") selected @endif >Select Country</option>
                              <option value="CHINA" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "CHINA") selected @endif >China</option>
                              <option value="GHANA" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "GHANA") selected @endif >Ghana</option>
                              <option value="NIGERIA" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "NIGERIA") selected @endif >Nigeria</option>
                              <option value="SENEGAL" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "SENEGAL") selected @endif >Senegal</option>
                              <option value="INDIA" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "INDIA") selected @endif >India</option>
                              <option value="USA" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "USA") selected @endif >USA</option>
                            </select>
                          </div>
                      </div>                                  
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                              <label for="categoryDiscount">Phone Number</label>
                              <input type="text" class="form-control" id="supplierPhone" name="supplierPhone" placeholder="Enter Phone Number" @if(!empty($getSupplierData['supplier_contact'])) value="{{$getSupplierData['supplier_contact']}}" @else value="{{old('supplier_contact')}}" @endif>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                          <label for="branchAddress">Supplier Address</label>
                          <textarea class="form-control" rows="3" name="supplierAddress" id="supplierAddress" placeholder="Enter Supplier Address">
                            @if(!empty($getSupplierData['supplier_address']))  {{$getSupplierData['supplier_address'] }} @else  {{ old('supplier_address') }} @endif
                          </textarea>
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