@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/settings') }}"><i class="ri-lock-4-line mr-1 float-left"></i>Password Settings</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/users') }}"><i class="ri-user-4-line mr-1 float-left"></i>Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Sales Personnel</li>
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
                        <h4 class="card-title mb-3">@if(empty($getUserData['id'])) <i class="fas fa-plus" > </i> {{ $title }}  @else <i class="fas fa-user-plus" > </i> {{ $title }}  @endif</h4>
                     </div>
                     
                  </div>
           
            <div class="card-body">

             <form method="POST"  @if(empty($getUserData['id'])) action="{{url('admin/add_edit_users')}}" @else action="{{url('admin/add_edit_users/'.$getUserData['id'])}}" @endif name="userForm" id="userForm" enctype="multipart/form-data">@csrf
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label>Select Role</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="role" id="role" style="width:100%">
                              <option value="" >*** Select User Role ***</option>
                              @foreach($roles as $role)
                                <option value="{{ $role }}"  @if(!empty($getUserData['role']) && $getUserData['role'] == $role ) selected @endif>{{ $role }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                        <div class="form-group">
                          <label for="fullname">Full Name</label>
                          <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Full Name" @if(!empty($getUserData['name'])) value="{{$getUserData['name']}}" @else value="{{old('name')}}" @endif>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>                                  
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label> Branch Name</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="branch_id" id="branch_id" style="width:100%">
                              <option value="" >*** Select Branch ***</option>
                              @foreach($branches as $branch)
                                <option value="{{ $branch['id'] }}"  @if(!empty($getUserData['branchId']) && $getUserData['branchId'] == $branch['id']) selected @endif>{{ $branch['branch_name'] }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="email"> Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" @if(!empty($getUserData['email'])) value="{{$getUserData['email']}}" @else value="{{old('email')}}" @endif>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="password"> Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter User Password" @if(!empty($getUserData['password'])) value="{{$getUserData['password']}}" disabled @else value="{{old('password')}}" @endif>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" @if(!empty($getUserData['username'])) value="{{$getUserData['username']}}" @else value="{{old('username')}}" @endif>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="role"> Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter User Phone Number" @if(!empty($getUserData['phone'])) value="{{$getUserData['phone']}}" @else value="{{old('phone')}}" @endif>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>                                     
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label for="userImage">User Image</label>
                            <div>
                              @if(!empty($getUserData['image'])) 
                                <img src="{{asset('backEnd/img/uploadedImages/usersImages/'.$getUserData['image'])}}" style="width:60px;"><br>
                                <!-- <a href="javascript:void(0)" class="confirmDelete" record="image" recordid="{{ $getUserData['id'] }}" >Delete Image</a> -->
                              @else 
                                <img src="{{asset('backEnd/img/uploadedImages/usersImages/user.jpg')}}" style="width:60px;">
                                <!-- <a href="javascript:void(0)" class="confirmDelete" record="image" recordid="{{ $getUserData['id'] }}" >Delete Image</a> -->
                              @endif
                            </div>
                            <br><br>
                            <div class="input-group mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="usersImage" id="usersImage">
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