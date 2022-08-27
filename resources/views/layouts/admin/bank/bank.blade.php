@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/suppliers') }}"><i class="ri-notification-line mr-1 float-left"></i>Suppliers</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/bankers') }}"><i class="ri-users-4-line mr-1 float-left"></i>Banks</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bank Accounts</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i>  Accounts With Banks</h4>
                     </div>
                     <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target="#addBank" title="Add New Bank Account"><i class="fas fa-plus"> </i> Add</button>
                     <!-- <a href="{{url('/admin/add_edit_bank')}}" class="btn btn-primary btn-sm add-list" data-toggle="tooltip" data-placement="top" data-original-title="Add New Bank"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">You can ADD and View all Suppliers</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="bank" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Bank Name</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Branch </th>
                            <th>Account Type</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                    @foreach($banks as $bank)
                      <tr >
                          <td>
                              <div class="checkbox d-inline-block">
                                  <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                  <label for="checkdelete" class="mb-0"></label>
                              </div>
                          </td>
                          
                          <td>{{$loop->iteration}}</td>
                          <td>{{$bank->bankname}}</td>
                          <td>{{$bank->acname}}</td>
                          <td>{{$bank->acbranch}}</td>
                          <td>{{$bank->acnumber}}</td>
                          <td>{{$bank->actype}}</td>
                          <td>@if($bank->ac_status==1)
                            <a class="updateBankStatus" id="bank-{{ $bank->id }}" bank_id="{{$bank->id}}" href="javascript:void(0)" style="color:#007bff">Active</a>
                          @else
                            <a class="updateBankStatus" id="bank-{{ $bank->id }}" bank_id="{{$bank->id}}" href="javascript:void(0)" style="color:#ff0000">Inactive</a>
                          @endif
                      </td>
                          <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Suppliers"
                                    href="{{ url('admin/add_edit_bank/'.$bank->id )}}"><i class="far fa-edit" style="font-size:18px;"></i></a>
                                <a class="badge bg-warning mr-2 confirmDelete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Suppliers"
                                    href="javascript:void(0)" record="bank" recordid="{{ $bank->id }}"><i class="fas fa-trash-alt mr-0" style="font-size:18px;"></i></a>
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
                            <th>Bank Name</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Branch </th>
                            <th>Account Type</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              


    @include('layouts.admin.bank.modal.add_bank')
@endsection