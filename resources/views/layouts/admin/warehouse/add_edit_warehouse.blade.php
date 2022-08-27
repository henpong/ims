@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/branches') }}"><i class="ri-home-4-line mr-1 float-left"></i>Branches</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/warehouses') }}"><i class="ri-home-4-line mr-1 float-left"></i>Warehouse</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Warehouse</li>
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
                        <h4 class="card-title mb-3"> <i class="fas fa-pen" > </i> Update Warehouse</h4>
                     </div>
                     
                  </div>
           
            <div class="card-body">

             <form method="POST" action="{{url('admin/add_edit_warehouse/'.$getWarehouseData['id'])}}" name="warehouseForm" id="warehouseForm" enctype="multipart/form-data" data-toggle="validator">@csrf 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                              <label>Warehouse Name</label>
                              <input type="text" class="form-control" id="warehouseName" name="warehouseName" placeholder="Enter Warehouse Name" @if(!empty($getWarehouseData['name'])) value="{{$getWarehouseData['name']}}" @else value="{{old('name')}}" @endif>
                          </div>
                      </div> 
                      
                      <div class="col-sm-6">                      
                          <div class="form-group">
                              <label>Warehouse Location</label>
                              <input type="text" class="form-control" id="warehouseLocation" name="warehouseLocation" placeholder="Enter Warehouse Location" @if(!empty($getWarehouseData['location'])) value="{{$getWarehouseData['location']}}" @else value="{{old('location')}}" @endif>
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