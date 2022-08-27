@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/suppliers') }}"><i class="ri-user-4-line mr-1 float-left"></i>Suppliers</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/bankers') }}"><i class="ri-home-4-line mr-1 float-left"></i>Bank Accounts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Bank Details</li>
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
                        <h4 class="card-title mb-3">@if(empty($getBranchData['id'])) <i class="fas fa-plus" > </i> {{ $title }}  @else <i class="fas fa-pen" > </i> {{ $title }}  @endif</h4>
                     </div>
                     
                  </div>
           
            <div class="card-body">

             <form method="POST" @if(empty($getBranchData['id'])) action="{{url('admin/add_edit_branches')}}" 
                    @else action="{{url('admin/add_edit_branches/'.$getBranchData['id'])}}" @endif name="branchForm" id="branchForm" enctype="multipart/form-data">@csrf
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                                <label>Branch Name *</label>
                                <input type="text" class="form-control" id="branchName" name="branchName" placeholder="Enter Branch Name" @if(!empty($getBranchData['branch_name'])) value="{{$getBranchData['branch_name']}}" @else value="{{old('branch_name')}}" @endif>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                              <label>Branch Colour *</label>
                              <select class="form-control selectpicker select2" data-style="py-0" name="branchColour" id="branchColour" style="width: 100%;" @if(!empty($getBranchData['branch_colour'])) value="{{$getBranchData['branch_colour']}}" @else value="{{old('branch_colour')}}" @endif>
                                <option value="" @if(isset($getBranchData['branch_colour'])) selected @endif>Select Colour</option>
                                <option value="RED">RED</option>
                                <option value="YELLOW">YELLOW</option>
                                <option value="GREEN">GREEN</option>
                                <option value="BLUE">BLUE</option>
                                <option value="PINK">PINK</option>
                                <option value="NONE">NONE</option>
                              </select>
                          </div>
                      </div>                                  
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                              <label>Phone Number</label>
                                <input type="text" class="form-control" id="branchPhone" name="branchPhone" placeholder="Enter Phone Number" @if(!empty($getBranchData['branch_contact'])) value="{{$getBranchData['branch_contact']}}" @else value="{{old('branch_contact')}}" @endif>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="branchAddress">Branch Address</label>
                            <textarea class="form-control" rows="3" name="branchAddress" id="branchAddress" placeholder="Enter Branch Address">
                            @if(!empty($getBranchData['branch_address'])) {{$getBranchData['branch_address']}} @else {{old('branch_address')}} @endif
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