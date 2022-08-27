@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-4-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/temporal_credit') }}"><i class="ri-circle-4-line mr-1 float-left"></i>Temporal Credit</a></li>
            <li class="breadcrumb-item active" aria-current="page">Credit Request(s)</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-sync-alt text-red"> </i> Credit Request(s)</h4>
                     </div>
                     <!-- <a href="#" class="btn btn-primary add-list"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">This is where you take decisions on the REQUEST sent by users.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="creditrequest" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
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
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Company</th>
                            <th>Requested By</th>
                            <th>Branch Name</th>
                            <th>Date Requested</th>
                            <th>Request Status</th>
                            <th>Credit Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody >
                      @foreach($creditors as $creditor)
                            <tr >
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                        <label for="checkdelete" class="mb-0"></label>
                                    </div>
                                </td>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$creditor->fullname}}</td>
                                <td>{{$creditor->customer_address}}</td>
                                <td>{{$creditor->customer_contact}}</td>
                                <td>{{$creditor->company}}</td>
                                <td>{{$creditor->users->name}}</td>
                                <td>{{$creditor->branch->branch_name}}</td>
                                <td>{{date("jS F, Y  H:i:s", strtotime($creditor->date_credited))}}</td>
                                <td>
                                  @if($creditor->credit_status == "Pending")
                                      <span style=color:#ff0000;font-weight:bold;>{{$creditor->credit_status}}</span>
                                  @elseif($creditor->credit_status == "Approved")
                                      <span style=color:#006b06;font-weight:bold;>{{$creditor->credit_status}}</span>
                                  @else
                                      <span style=color:#ff0000;font-weight:bold;>{{$creditor->credit_status}}</span>
                                  @endif
                                </td>
                                <td>
                                  @if($creditor->status == 2)
                                      <span style=color:#ff0000;font-weight:bold;>Not Credited</span>
                                  @elseif($creditor->status == 3)
                                      <span style=color:#006b06;font-weight:bold;>Credited</span>
                                  @endif 
                                </td>
                                <td style="display:inline-flex"> 
                                  @if($creditor->credit_status == "Pending")
                                    <a title="TAKE DECISION"  href="#updateRequest" data-toggle="modal" data-target="#updateRequest{{ $creditor->id }}" data-request_id="{{ $creditor->id }}" data-credit_status="{{ $creditor->credit_status }}"><i class="fas fa-pencil-alt fa-spin" style="font-size:18px;padding-top:15px;"></i></a>
                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                  @endif
                                    <a title="VIEW SUMMARY INFO"  href="#viewRequest" data-toggle="modal" data-target="#viewRequest{{ $creditor->id }}" data-request_id="{{ $creditor->id }}" data-credit_status="{{ $creditor->credit_status }}"><i class="far fa-eye text-green" style="font-size:18px;padding-top:15px;"></i></a>
                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a title="VIEW DETAILED INFO"  href="#" data-request_id="{{ $creditor->id }}" data-credit_status="{{ $creditor->credit_status }}"><i class="far fa-eye text-blue" style="font-size:18px;padding-top:15px;"></i></a>
                                </td>
                              </tr>


                              <!-- CREDIT REQUEST MODAL -->
                              <div class="modal fade" id="updateRequest{{ $creditor->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateRequestForm" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header" >
                                      <h5 class="modal-title" id="updateRequestForm"> <i class="fas fa-pen"> </i> UPDATE REQUEST</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="color: #ff0008;">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                    
                                    <form name="creditRequestForm" id="creditRequestForm" action="{{url('/admin/credit_request_decision/'.$creditor->id)}}" method="POST" enctype="multipart/form-data">@csrf 
                                      <!-- UPDATE CREDIT REQUEST -->

                                        <!-- <div class="card-body"> -->
                                          <div class="row">
                                              <div>
                                                <small style="color:#ff0000;padding-left:50px">Please note that the decision taken <strong>CANNOT</strong> be reverted! Thank you.</small>
                                              </div><br><br>
                                                <!--Select Request-->
                                                <label for="request_status" class="col-md-4">Take Decision</label>
                                              
                                              <div class="col-md-7">
                                                <select class="form-control select2" name="request_status" id="request_status" style="width: 100%;">

                                                  <option value="">*** SELECT DECISION***</option>
                                                  <option value="Approved"> Approved </option>
                                                  <option value="Rejected"> Rejected </option>
                                                  <option value="Pending"> Pending </option>
                                                  
                                                </select>
                                              </div>
                                                <!--End Select Request -->

                                              <input type="hidden" id="request_id" name="request_id" value="{{ $creditor->id }}">
                                              <input type="hidden" id="branch_id" name="branch_id" value="{{ $creditor->branch->id }}">
                                          </div>
                                          <!-- /.row -->

                                        </div>
                                        <div class="modal-footer">
                                          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                          <button type="sumbit" class="btn btn-md btn-primary">Submit</button>
                                        </div>
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!-- END OF EDIT CATEGORIES MODAL -->



                              <!-- CREDITOR INFO MODAL -->
                              <div class="modal fade" id="viewRequest{{ $creditor->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="viewRequestForm" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header" >
                                      <h5 class="modal-title" id="viewRequestForm"> <i class="fas fa-user text-green"> </i> CREDITOR'S INFORMATION DETAILS</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="color: #ff0008;">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                    
                                    <form name="creditRequestForm" id="creditRequestForm" action="{{url('/admin/credit_request_decision/'.$creditor->id)}}" method="POST" enctype="multipart/form-data">@csrf 
                                                                      
                                          <!-- Creditor Information -->
                                          
                      
                                          <div class="row">
                                            <div class="col-md-12">
                                                <span style="padding-left:300px;font-size:25px"><strong> {{ strtoupper($creditor->fullname) }} </strong></span>
                                            </div>
                                            <br><br><br><br>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="qtyctns">Previous Balance (GHC):</label>
                                                <p>{{ number_format( $creditor->balance,2) }}</p>
                                              </div>
                                            

                                              <div class="form-group">
                                                  <label for="dateAdded">Net Business Income (GHC):</label>
                                                  <p>{{ number_format( $creditor->income,2) }}</p>
                                              </div>
                                          </div>
                                            
                                          <!-- /.row -->

                                          
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label> Total Amount of Credit (GHC):</label>
                                                  <p>{{ number_format( $creditor->totalamt,2) }}</p>
                                                </div>
                                                
                                              
                                                <div class="form-group">
                                                  <label> Guarantor Name:</label>
                                                  <p>{{ $creditor->guarantor }}</p>
                                                </div>
                                              </div>


                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label> Guarantor Phone Number:</label>
                                                  <p>{{ $creditor->guarantor_contact }}</p>
                                                </div>

                                              
                                                <div class="form-group">
                                                  <label> Credit Status:</label>
                                                  <p>{{ $creditor->credit_status }}</p>
                                                </div>
                                              </div>

                                              
                                              <div class="col-md-6">
                                                <div class="form-group">
                                                  <label> Years In Business:</label>
                                                  <p>{{ $creditor->years }}</p>
                                                </div>

                                              
                                                <div class="form-group">
                                                  <label> </label>
                                                  <p> </p>
                                                </div>
                                              </div>

                                            </div>
                                            <!-- /.row -->

                                        </div>
                                        <div class="modal-footer" style="text-align:center">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                          <!-- <button type="sumbit" class="btn btn-md btn-primary">Submit</button> -->
                                        </div>
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              <!-- END OF CREDITOR INFO DETAILS MODAL -->


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
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Company</th>
                            <th>Requested By</th>
                            <th>Branch Name</th>
                            <th>Date Requested</th>
                            <th>Request Status</th>
                            <th>Credit Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

  
@endsection