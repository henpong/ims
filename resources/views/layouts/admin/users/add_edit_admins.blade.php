@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/users') }}"><i class="ri-user-4-line mr-1 float-left"></i>Users</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/admins') }}"><i class="ri-user-4-line mr-1 float-left"></i>Admin Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Admin Users</li>
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
                    <h4 class="card-title mb-3">@if(empty($getAdminData['id'])) <i class="fas fa-plus" > </i> {{ $title }}  @else <i class="fas fa-pen" > </i> {{ $title }}  @endif</h4>
                </div>
                
            </div>
           
            <div class="card-body">

             <form method="POST" @if(empty($getAdminData['id'])) action="{{url('admin/add_edit_admin')}}" @else action="{{url('admin/add_edit_admin/'.$getAdminData['id'])}}" @endif name="userForm" id="userForm" enctype="multipart/form-data">@csrf
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label>Select Role</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="role" id="role" style="width:100%">
                              <option value="" >*** Select User Role ***</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}"  @if(!empty($getAdminData['type']) && $getAdminData['type'] == $role ) selected @endif>{{ $role }}</option>
                                @endforeach
                            </select>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                        <div class="form-group">
                          <label for="fullname">Full Name</label>
                          <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Full Name" @if(!empty($getAdminData['name'])) value="{{$getAdminData['name']}}" @else value="{{old('name')}}" @endif>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>                                  
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label> Branch Name</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="branchid" id="branchid" style="width:100%">
                                <option value="" >*** Select Branch ***</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch['id'] }}"  @if(!empty($getAdminData['branchId']) && $getAdminData['branchId'] == $branch['id']) selected @endif>{{ $branch['branch_name'] }}</option>
                                
                                @endforeach
                            </select>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="email"> Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" @if(!empty($getAdminData['email'])) value="{{$getAdminData['email']}}" @else value="{{old('email')}}" @endif>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="password"> Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter User Password" @if(!empty($getAdminData['password'])) value="{{$getAdminData['password']}}" disabled  @else value="{{old('password')}}" @endif>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" @if(!empty($getAdminData['username'])) value="{{$getAdminData['username']}}" @else value="{{old('username')}}" @endif>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="role"> Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter User Phone Number" @if(!empty($getAdminData['phone'])) value="{{$getAdminData['phone']}}" @else value="{{old('phone')}}" @endif>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="userImage">User Image</label>
                            <div>
                                @if(!empty(Auth::guard('admin')->user()->image))
                                    <img src="{{asset('backEnd/img/uploadedImages/adminImages/'.Auth::guard('admin')->user()->image)}}" alt="user" style="width:60px;height:60px">
                                @else 
                                    <img src="{{asset('backEnd/img/uploadedImages/adminImages/user.jpg')}}" alt="user" style="width:60px;height:60px">
                                @endif
                                
                            </div>
                            <br><br>
                            <div class="input-group mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="userImage" id="userImage">
                                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                </div>                             
                            </div>
                            <small style="color:#ff0000">(Recommended Image size: 60pxx60px)</small>
                          </div>
                      </div>                                     
                  </div> 
                  
                  <button type="button" class="btn btn-secondary mr-10" data-dismiss="modal"> <i class="fas fa-times"> </i> Close</button>                          
                  <button type="submit" class="btn btn-primary mr-2" ><i class="fas fa-paper-plane"></i>Submit</button>
             </form>

            </div>
        
      </div>
    </div>
              

@endsection