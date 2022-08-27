@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/branches') }}"><i class="ri-home-line mr-1 float-left"></i>Branches</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mainwarehouse') }}"><i class="ri-notification-line mr-1 float-left"></i>Warehouse</a></li>
            <li class="breadcrumb-item active" aria-current="page">Expenses</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-file-archive text-blue"> </i> Daily Expenses</h4>
                     </div>
                     <!-- <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target="#addCategory" title="Add New Category"><i class="fas fa-plus"> </i> Add</button> -->
                     <!-- <a href="{{url('/admin/add_edit_category')}}" class="btn btn-primary btn-sm add-list" data-toggle="tooltip" data-placement="top" data-original-title="Add New Category"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">You can view all EXPENSES MADE</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="expenses" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Branch Name</th>
                            <th>Description</th>
                            <th>Amount (GHC)</th>
                            <th>Date of Expenses</th>
                            <th>Made By</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($expenses as $expen)
                          <tr >
                              <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                              </td>
                              <td>{{ $loop->iteration }}</td>
                                <td>{{ $expen->branch->branch_name}}</td>
                                <td>{{ $expen->description }}</td>
                                <td style="text-align:right">{{ number_format($expen->amount,2) }}</td>
                                <td>{{ date("jS F, Y ",strtotime($expen->expense_date)) }}</td>
                                <td>{{ $expen->user->name }}</td>
                                <td>
                                    @if( $expen->status == 1)
                                        {{ " Debited " }}
                                    @else 
                                        {{ " Not Debited " }}
                                    @endif
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
                            <th>Branch Name</th>
                            <th>Description</th>
                            <th>Amount (GHC)</th>
                            <th>Date of Expenses</th>
                            <th>Made By</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              


@endsection