@extends('layouts.adminLayout.admin_design')

@section('content')



    <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid"> 

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Catalogues</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>

              <li class="breadcrumb-item"><a href="{{url('/admin/settings')}}">Password Settings</a></li>

               <li class="breadcrumb-item"><a href="{{url('/admin/users')}}">Users</a></li>

              <!--<li class="breadcrumb-item"><a href="{{url('/admin/categories')}}">Categories</a></li> -->

              <li class="breadcrumb-item active">Add & Update Users</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>

 

    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <!-- Display Error Messages In a Loop -->

              

          @if ($errors->any())

            <div class="alert alert-danger" style="margin-top:10px;">

              <ul>

                @foreach ($errors->all() as $error)

                  <li>{{ $error }}</li>

                @endforeach

              </ul>

            </div>

          @endif



          <!-- Display Error Message -->

          @if(Session::has('error_message'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:10px;">

              {{Session::get('error_message')}}

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>

              </button>

            </div>

          @endif





          <!-- Display Success Message -->

          @if(Session::has('success_message'))

          <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">

              {{Session::get('success_message')}}

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">

              <span aria-hidden="true">&times;</span>

              </button>

          </div>

          @endif





      <form method="POST" @if(empty($getUserData['id'])) action="{{url('admin/add_edit_users')}}" 

      @else action="{{url('admin/add_edit_users/'.$getUserData['id'])}}" @endif name="userForm" id="userForm" enctype="multipart/form-data">@csrf

        <!-- ADD CATEGORIES -->

        <div class="card card-default">

          <div class="card-header">

            <h3 class="card-title">@if(empty($getUserData['id'])) <i class="fas fa-plus" > </i> {{ $title }}  @else <i class="fas fa-pen" > </i> {{ $title }}  @endif</h3>



            <div class="card-tools">

              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>

            </div>

          </div>

          <!-- /.card-header -->

          <div class="card-body">

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                    <label for="branchid">Select Role</label>

                      <select class="form-control select2" name="role" id="role" style="width: 100%;" >

                      <option value="" >*** Select User Role ***</option>

                      @foreach($roles as $role)

                        <option value="{{ $role }}"  @if(!empty($getUserData['role']) && $getUserData['role'] == $role ) selected @endif>{{ $role }}</option>

                      @endforeach

                    </select>

                    

                </div>



                <div class="form-group">

                    <label for="branchid">Branch Name</label>

                    <select class="form-control select2" name="branchid" id="branchid" style="width: 100%;" >

                    <option value="" >*** Select Branch ***</option>

                    @foreach($branches as $branch)

                      <option value="{{ $branch['id'] }}"  @if(!empty($getUserData['branchId']) && $getUserData['branchId'] == $branch['id']) selected @endif>{{ $branch['branch_name'] }}</option>

                      

                    @endforeach

                  </select>

                </div>

              </div>

              <!-- /.col -->

              <div class="col-md-6">

              <!-- Email Address -->

                <div class="form-group">

                    <label for="fname">Full Name</label>

                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Full Name" @if(!empty($getUserData['name'])) value="{{$getUserData['name']}}" @else value="{{old('name')}}" @endif>



                </div>

                <!-- End Email Address -->



                <div class="form-group">

                  

                  <label for="email"> Email Address</label>

                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" @if(!empty($getUserData['email'])) value="{{$getUserData['email']}}" @else value="{{old('email')}}" @endif>

                  

                  <!-- <label for="role"> Role</label> -->

                </div>

              </div>

            </div>

            <!-- /.row -->



            <div class="row">

            <!-- for="fname" -->

              <div class="col-12 col-sm-6">

                <div class="form-group">

                  <label for="role"> Password</label>

                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter User Password" @if(!empty($getUserData['password'])) value="{{$getUserData['password']}}" @else value="{{old('password')}}" @endif>

                </div>



                <div class="form-group">

                    <label for="username">Username</label>

                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" @if(!empty($getUserData['username'])) value="{{$getUserData['username']}}" @else value="{{old('username')}}" @endif>

                </div>

              </div>

            

              <!-- User Image -->

              <div class="col-12 col-sm-6">

                <div class="form-group">

                  <label for="role"> Phone Number</label>

                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter User Phone Number" @if(!empty($getUserData['phone'])) value="{{$getUserData['phone']}}" @else value="{{old('phone')}}" @endif>

                </div>





                 <div class="form-group">

                    <label for="branchAddress">User Image</label>

                    <div>

                      @if(!empty($getUserData['image']))

                        <img src="{{asset('backEnd/img/uploadedImages/usersImages/'.$getUserData['image'])}}" style="width:60px;"><br>

                        <!-- <a href="javascript:void(0)" class="confirmDelete" record="image" recordid="{{ $getUserData['id'] }}" >Delete Image</a> -->

                      @endif

                    </div>

                    <br><br>

                    <div class="input-group">

                    <div class="custom-file">

                      <input type="file" class="custom-file-input" name="userImage" id="userImage">

                      <label class="custom-file-label" for="userImage">Choose file</label>

                    </div>

                    

                    </div>

                    <div> <small style="color:#ff0000">(Recommended Image size: 60x60)</small></div>

                </div>

              </div>



            </div>

          </div>

          <!-- /.card-body -->

          <div class="card-footer">

            <button type="submit" class="btn btn-md btn-success" style="float:right">Submit</button>

          </div>

        </div>

      </form>

      

      </div><!-- /.container-fluid -->

    </section>

    <!-- /.content -->

  </div>

<!-- /.content-wrapper -->



@endsection