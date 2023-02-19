@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="nav-icon fas fas fa-sync-alt fa-spin text-red"></i> Low Stock Request</h1>
          </div> -->
          <div class="col-sm-12 text-right">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('/admin/settings')}}">Password Settings</a></li>
              <li class="breadcrumb-item active">  Update Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
<!-- <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details of Daily Sales</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br> -->

<div class="col-sm-4">

<!-- Display Error Messages In a Loop -->
<div class="container-fluid"> 
<br><br><br><br><br>
          @if ($errors->any())
            <div class="alert alert-danger" style="margin:20px;width:40%;">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

    <div class="card card-primary">
      <div class="card-header d-flex justify-content-between">
          <div class="header-title">
            <h4 class="card-title"><i class="fas fa-user-plus" > </i> Update Profile Details</h4>
          </div>
      </div>
      <div class="card-body">
        <!-- form start -->
        <form role="form" method="POST" action="{{('/admin/update_admin_details')}}" name="updateAdminDtailsForm" id="updateAdminDtailsForm" enctype="multipart/form-data">@csrf
                <div class="card-body">

                <div class="image">
                  @if((Auth::guard('admin')->user()->image) == "")
                    <img src="{{asset('backEnd/img/uploadedImages/adminImages/user.jpg')}}" class="img-circle elevation-2" alt="User Image" style="width:150px;height:150px;margin-left:35%;">
                  @else
                    <img src="{{asset('backEnd/img/uploadedImages/adminImages/'.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image" style="width:150px;height:150px;margin-left:35%;">
                  @endif
                  <br>
                  <small style="margin-left:35%;">Uploaded/Current Image</small>
                </div>

                  <div class="form-group">
                    <label for="currentEmail">Role</label>
                    <input class="form-control" value="{{Auth::guard('admin')->user()->type}}" readonly="">
                  </div>
                
                  <div class="form-group">
                    <label for="currentEmail">Username</label>
                    <input class="form-control" value="{{Auth::guard('admin')->user()->username}}" readonly="">
                  </div>

                  <div class="form-group">
                    <label for="adminName">Full Name</label>
                    <input type="text" class="form-control" id="adminName" name="adminName" value="{{Auth::guard('admin')->user()->name}}" placeholder="Enter Admin Full Name" required>
                  </div>

                  <div class="form-group">
                    <label for="adminPhone">Phone Number</label>
                    <input type="text" class="form-control" id="adminPhone" name="adminPhone" value="{{Auth::guard('admin')->user()->phone}}" placeholder="Enter Admin Phone Number" required>
                  </div>

                  <div class="form-group">
                    <label for="adminImage">Admin Image</label>
                    <!-- <input type="file" class="form-control" id="adminImage" name="adminImage" accept="image/*"> -->
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="adminImage" name="adminImage" accept="image/*">
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                    </div>
                  </div>                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
    </div>
</div>
</div>
</div>




@endsection