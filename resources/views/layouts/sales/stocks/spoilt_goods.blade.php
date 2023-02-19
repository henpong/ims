@extends('layouts.salesLayout.sales_design')
@section('content')

<?php
    use Illuminate\Support\Facades\Auth;
    use App\Models\SpoiltGoods;
    // use App\Models\Customers;

    $getproducts = SpoiltGoods::getproducts();
    // dd($getproducts); die;


?>


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/stocks') }}"><i class="ri-user-line mr-1 float-left"></i>Stocks</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/returned_goods') }}"><i class="ri-user-line mr-1 float-left"></i>Returned Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Spoilt Products</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon far fa-circle text-red"> </i> Spoilt Products</h4>
                </div>
                <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addSpoiltGoods" data-backdrop="static">
                    <i class="fas fa-plus"></i>
                    Add
                </button>
            </div>
           
            <div class="card-body">

            <p class="mb-0">This is where you check all GOODS SPOILT/EMPTY.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="spoiltgoods" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty Spoilt/Empty</th>
                            <th>Condition of Goods</th>
                            <th>Brief Description</th>
                            <th>Date Spoilt/Empty</th>
                            <th>Checked By</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($spoilt as $goods)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $goods->products->product_code }}</td>
                                <td>{{ $goods->products->product_name }}</td>
                                <td>{{ $goods->qty_spoilt }}</td>
                                <td>{{ $goods->condition }}</td>
                                <td>{{ $goods->description }}</td>
                                <td>{{ date("jS F, Y ",strtotime($goods->spoilt_date)) }}</td>
                                <td>{{ $goods->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty Spoilt/Empty</th>
                            <th>Condition of Goods</th>
                            <th>Brief Description</th>
                            <th>Date Spoilt/Empty</th>
                            <th>Checked By</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              




@include('layouts.sales.stocks.modal.spoilt_stock')
@endsection