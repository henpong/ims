@extends('layouts.salesLayout.sales_design')
@section('content')

<?php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Products;

    $getlowproducts = Products::getlowproducts();
    // dd($getlowproducts); die;
?>


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/lowstockrequest') }}"><i class="ri-user-line mr-1 float-left"></i>Low Stock Request</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Stocking</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">


                <!-- Display Error Messages In a Loop -->
                @if ($errors->any())
                  <div class="alert bg-danger" style="margin-top:10px;width:40%">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                 @endif


            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Product Stocking</h4>
                </div>
                <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addStock" data-backdrop="static">
                    <i class="fas fa-plus"></i>
                    Add
                </button>
            </div>
           
            <div class="card-body">

             <p class="mb-0">This is where you check all you have STOCKED.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="stocks" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty (ctns)</th>
                            <th>Qty (pcs)</th>
                            <th>Stocked By</th>
                            <th>Date Stocked</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($stocks as $stock)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $stock->products->product_code }}</td>
                                <td>{{ $stock->products->product_name }}</td>
                                <td>{{ $stock->qty_ctn }}</td>
                                <td>{{ $stock->qty_pcs }}</td>
                                <td>{{ $stock->stocked_by }}</td>
                                <td>{{ date("jS F, Y ",strtotime($stock->stock_date)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty (ctns)</th>
                            <th>Qty (pcs)</th>
                            <th>Stocked By</th>
                            <th>Date Stocked</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              




@include('layouts.sales.stocks.modal.add_stock')

  
@endsection