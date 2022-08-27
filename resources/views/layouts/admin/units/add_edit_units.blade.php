@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/brands') }}"><i class="ri-user-line mr-1 float-left"></i>Brands</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/units') }}"><i class="ri-home-4-line mr-1 float-left"></i>Units</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add & Update Units</li>
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
                        <h4 class="card-title mb-3"> <i class="fas fa-pen" > </i> {{ $title }} </h4>
                     </div>
                     
                  </div>
           
            <div class="card-body">

             <form method="POST" action="{{url('admin/add_edit_units/'.$getUnitsData['id'])}}" name="unitForm" id="unitForm" enctype="multipart/form-data" data-toggle="validator">@csrf 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                                <label>Unit Name </label>
                                <input type="text" class="form-control" id="unitName" name="unitName" placeholder="Enter Unit Name" @if(!empty($getUnitsData['unit_name'])) value="{{$getUnitsData['unit_name']}}" @else value="{{old('unit_name')}}" @endif>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                                <label>Short Name </label>
                                <input type="text" class="form-control" id="shortName" name="shortName" placeholder="Enter Short Name" @if(!empty($getUnitsData['short_name'])) value="{{$getUnitsData['short_name']}}" @else value="{{old('short_name')}}" @endif>
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