@extends('layouts.salesLayout.sales_design')
@section('content')
<div class="col-sm-12" style="display:block">

    <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('sales/customers')}}"><i class="ri-user-line mr-1 float-left"></i>Customers</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Customer Transaction</li>
        </ol>
      </nav>
    </div>
    <br>


    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title"> <i class="fas fa-user text-blue"> </i> New Customer Transaction</h4>
                </div>
            </div>


            <div class="card-body">

            <p style="text-align:center;color:#ff0000">Please choose the appropriate customer</p>
                <div class="col-12" style="text-align:center;margin-top:150px;margin-bottom:150px">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#customerTrans" data-backdrop="static" style="margin-right:90px;height:50px;width:300px"> Walk-In-Customer </button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#detailedCustomerTrans" data-backdrop="static" style="margin-right:90px;height:50px;width:300px"> Detailed Customer </button>
                </div>
            </div>
        </div>
    </div>
</div>



@include('layouts.sales.transaction.modal.trans_cust_walkin')
@include('layouts.sales.transaction.modal.trans_cust_prescription')

@endsection