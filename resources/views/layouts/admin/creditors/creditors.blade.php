@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/customers') }}"><i class="ri-users-line mr-1 float-left"></i>Customers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Creditors</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">


            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Creditors</h4>
                </div>
                <!-- <a href="#" class="btn btn-primary add-list"><i class="fas fa-plus mr-3"></i>Add </a> -->
                
                <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addCreditors" data-backdrop="static">
                    <i class="fas fa-plus"> </i> Add
                </button>
            </div>
           
            <div class="card-body">

             <p class="mb-0">This is where you check all CREDITORS you have served.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="creditors" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Company Name</th>
                            <th>Credit Date</th>
                            <th>Applied By</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                                @foreach($creditors as $credit) 
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $credit->fullname }}</td>
                                        <td>{{ $credit->customer_contact }}</td>
                                        <td>{{ $credit->customer_address }}</td>
                                        <td>{{ $credit->company }}</td>
                                        <td>{{ date("jS F, Y  H:i:s",strtotime($credit->created_at)) }}</td>
                                        <td>{{ $credit->users->name }}</td>
                                        <td>
                                           
                                            @if( $credit->credit_status == "Pending")
                                                <span style=color:#FF0000;font-weight:bold;>{{ $credit->credit_status }}</span>
                                            @elseif( $credit->credit_status == "Approved")
                                                <span style=color:#006b06;font-weight:bold;>{{ $credit->credit_status }}</span>
                                            @else
                                                <span class="badge badge-danger" style="font-weight:bold;">{{ $credit->credit_status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($credit->credit_status == 'Approved')
                                                <a href="{{ url('admin/credit_account_summary/'.$credit->id) }}" title="Open Creditor's Book"> <i class="fas fa-share text-blue"></i> </a>
                                            @else
                                                <a href="javascript:void(0)" title="Open Creditor's Book"> <i class="fas fa-share text-blue"></i> </a>
                                            @endif
                                             &nbsp;&nbsp;&nbsp;
                                            <a  href="javascript:void(0)" title="Delete Creditor" data-toggle="modal" data-target="#deleteCredit{{ $credit->id }}" data-backdrop="false"> <i class="fas fa-trash text-red"></i> </a>
                                        </td>
                                    </tr>


                                    <!-- Delete Creditor -->
                                    <div class="modal fade" id="deleteCredit{{ $credit->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCredit" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addCreditor"><i class="fas fa-trash text-red"></i> DELETE CREDITOR</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" style="color: #ff0000;">×</span>
                                                    </button>
                                                </div>


                                                    <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                                                        

                                                        <div class="col-12">
                                                            <p>
                                                                Ooooh why do you want to delete me ?<br>
                                                                Sorry I won't allow you to delete me.  Press "OK" to go back.
                                                            </p>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                                                            <i class="fas fa-times text-white fa-spin"> </i> &nbsp;&nbsp;
                                                            OK
                                                        </button>
                                                        <!-- <button class="btn btn-sm btn-primary" type="submit" >
                                                            <i class="fas fa-paper-plane text-white"> </i> &nbsp;&nbsp;
                                                            Submit
                                                        </button> -->
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Delete Creditor -->
                                    
                                @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Company Name</th>
                            <th>Credit Date</th>
                            <th>Applied By</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

  
    @include('layouts.sales.creditors.modal.add_creditor')
@endsection