@extends('layouts.salesLayout.sales_design')
@section('content')




  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/creditors') }}"><i class="ri-user-line mr-1 float-left"></i>Creditors</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail of Today's Credit Paid</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Detail of Today's Credit Paid</h4>
                </div>
                <!-- <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addExpense" data-backdrop="static">
                    <i class="fas fa-plus"> </i> Add
                </button> -->
            </div>
           
            <div class="card-body">

            <p class="mb-0">This is where you view all CREDITS PAID FOR TODAY.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="creditpaiddestail" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Branch Name</th>
                            <th>Customer Name</th>
                            <th>Customer Phone #</th>
                            <th>Amount (GHC) Paid</th>
                            <th>Date of Payment</th>
                            <th>Payment Received By</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($creditpaiddetail as $creditpaid)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $creditpaid->branch->branch_name}}</td>
                                <td>{{ $creditpaid->customers->fullname }}</td>
                                <td>{{ $creditpaid->customers->customer_contact }}</td>
                                <td style="text-align:right">{{ number_format($creditpaid->payment,2) }}</td>
                                <td>{{ date("jS F, Y ",strtotime($creditpaid->paid_date)) }}</td>
                                <td>{{ $creditpaid->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Branch Name</th>
                            <th>Customer Name</th>
                            <th>Customer Phone #</th>
                            <th>Amount (GHC) Paid</th>
                            <th>Date of Payment</th>
                            <th>Payment Received By</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              


@endsection