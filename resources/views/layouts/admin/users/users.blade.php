@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/customers') }}"><i class="ri-user-line mr-1 float-left"></i>Customers</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="ri-home-4-line mr-1 float-left"></i>Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i>  All Sales Personnel</h4>
                     </div>
                     <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target="#addUser"><i class="fas fa-plus"> </i> Add</button>
                     <!-- <a href="{{url('/admin/add_edit_users')}}" class="btn btn-primary btn-sm add-list" data-toggle="tooltip" data-placement="top" data-original-title="Add New User"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">You can ADD and View all Sales Personnel</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="users" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Full Name</th>
                            <!-- <th>Email Address</th> -->
                            <th>Password</th>
                            <th>Username</th>
                            <th>Phone Number</th>
                            <th>Image</th>
                            <th>Branch</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                    @foreach($users as $user)
                      <tr >
                          <td>
                              <div class="checkbox d-inline-block">
                                  <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                  <label for="checkdelete" class="mb-0"></label>
                              </div>
                          </td>
                          
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $user->name }}</td>
                          <!-- <td>{{ $user->email }}</td> -->
                          <td>{{ '******' }}</td>
                          <td>{{ $user->username }}</td>
                          <td>{{ $user->phone }}</td>
                          <td>
                              @if($user->image !== "NULL")
                                  <img src="{{asset('backend/img/uploadedImages/usersImages/'.$user->image)}}" alt="user" style="width:60px;height:60px">
                              @else 
                                  <img src="{{asset('backend/img/uploadedImages/usersImages/user.jpg')}}" alt="user" style="width:60px;height:60px">
                              @endif
                              <!-- <img src="{{ asset('backEnd/img/uploadedImages/usersImages/'.$user->image) }}" alt="" style="width:60px;height:60px"> -->
                          </td>
                          <td>{{ $user->userbranch->branch_name }}</td>
                          <td>{{ $user->role }}</td>
                          <td>
                              @if( $user->status == 1 )
                                <a class="updateUserStatus" id="user-{{ $user->id }}" user_id="{{ $user->id }}" href="javascript:void(0)" style="color:#007bff">Active</a>
                              @else
                                <a class="updateUserStatus" id="user-{{ $user->id }}" user_id="{{ $user->id }}" href="javascript:void(0)" style="color:#ff0000">Inactive</a>
                              @endif
                          </td>
                          <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Users"
                                    href="{{ url('/admin/add_edit_users/'.$user->id) }}"><i class="far fa-edit" style="font-size:18px;"></i></a>
                                <!-- <a class="badge bg-warning mr-2 confirmDelete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Users"
                                    href="javascript:void(0)" record="user" recordid="{{ $user->id }}"><i class="fas fa-trash-alt mr-0" style="font-size:18px;"></i></a> -->
                            </div>

                          
                          </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Full Name</th>
                            <!-- <th>Email Address</th> -->
                            <th>Password</th>
                            <th>Username</th>
                            <th>Phone Number</th>
                            <th>Image</th>
                            <th>Branch</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

@include('layouts.admin.users.modal.add_user')
@endsection