@extends('layouts.salesLayout.sales_design')
@section('content')

<?php
    use Illuminate\Support\Facades\Auth;
    use App\ReturnedGoods;
    // use App\Customers;

    $getproducts = ReturnedGoods::getproducts();
    // dd($getproducts); die;


    $getreceipt = ReturnedGoods::getreceipt();
    // dd($getreceipt); die;

?>


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/lowstock') }}"><i class="ri-user-line mr-1 float-left"></i>Low Stocks</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/stocks') }}"><i class="ri-user-line mr-1 float-left"></i>Stocks</a></li>
            <li class="breadcrumb-item active" aria-current="page">Returned Product(s)</li>
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


            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title mb-3"><i class="nav-icon far fa-circle text-blue"> </i> Returned Goods</h4>
                </div>
                <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addReturnedGoods" data-backdrop="static">
                    <i class="fas fa-plus"></i>
                    Add
                </button>
            </div>
           
            <div class="card-body">

            <p class="mb-0">This is where you check all STOCKS RETURNED.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="returnedgoods" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty Returned</th>
                            <th>Condition of Drugs </th>
                            <th>Receipt No.</th>
                            <th>Customer's Name</th>
                            <th>Brief Description</th>
                            <th>Date Returned</th>
                            <th>Received By</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($returned as $goods)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $goods->products->product_code }}</td>
                                <td>{{ $goods->products->product_name }}</td>
                                <td>{{ $goods->qty_returned }}</td>
                                <td>{{ $goods->reason }}</td>
                                <td>{{ $goods->customer->or_no }}</td>
                                <td>{{ $goods->customer->fullname }}</td>
                                <td>{{ $goods->description }}</td>
                                <td>{{ date("jS F, Y ",strtotime($goods->returned_date)) }}</td>
                                <td>{{ $goods->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty Returned</th>
                            <th>Condition of Drugs </th>
                            <th>Receipt No.</th>
                            <th>Customer's Name</th>
                            <th>Brief Description</th>
                            <th>Date Returned</th>
                            <th>Received By</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              



@include('layouts.sales.stocks.modal.returned_stock')

@endsection