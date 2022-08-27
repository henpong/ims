@extends('layouts.salesLayout.sales_design')
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
              <li class="breadcrumb-item"><a href="{{url('/sales/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"> Update Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>


<div class="col-sm-6">

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
            <h4 class="card-title"><i class="fas fa-lock" > </i> Update Password</h4>
          </div>
      </div>
      <div class="card-body">
        <!-- form start -->
        <form role="form" method="POST" action="{{ url('sales/update_password') }}" name="updatePasswordForm" id="updatePassword">@csrf
            <div class="card-body">
              <div class="form-group">
                <label for="currentEmail">Email address</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $userdetails->email }}" placeholder="Enter Email Address" readonly>
              </div>
              <div class="form-group">
                <label for="currentPass">Current Password</label>
                <input type="password" class="form-control" name="currentPass" id="currentPass" placeholder="Enter Current Password">
                <span id="chkCurrentPass"></span>
              </div>

              <div class="form-group">
                <label for="newPass">New Password</label>
                <input type="password" class="form-control" name="newPass" id="newPass" placeholder="Enter New Password">
                <span id="newPassword"></span>
              </div>

              <div class="form-group">
                <label for="confirmPass">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPass" id="confirmPass" placeholder="Confirm Password">
                <span id="confirmPassword"></span>
              </div>                 
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-lock"> </i> Update Password</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>

				

@endsection