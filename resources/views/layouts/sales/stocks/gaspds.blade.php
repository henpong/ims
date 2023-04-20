@extends('layouts.salesLayout.sales_design')
@section('content')

<?php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Products;

    $getlowproducts = Products::getlowproducts();
    // dd($getlowproducts); die;

    $getallgas = Products::getallgas();
    // dd($getallgas); die;
?>


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/lowstockrequest') }}"><i class="ri-user-line mr-1 float-left"></i>Low Stock Request</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gas Pounds</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">

            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title mb-3"><i class="nav-icon fas fa-wine-bottle text-blue"> </i> Create Gas Pounds</h4>
                </div>
                <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addGas" data-backdrop="static">
                    <i class="fas fa-plus"></i>
                    Create Pounds
                </button>
            </div>
           
            <div class="card-body">

             <p class="mb-0">This is where you check all the gas pounds you have CREATED.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="stocks" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Created By</th>
                            <th>Date Created</th>
                            <th>Price Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($gaspds as $gas)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gas->product_code }}</td>
                                <td>{{ $gas->gas_pds_name }}</td>
                                <td>{{ $gas->user->name }}</td>
                                <td>{{ date("jS F, Y  H:m:i",strtotime($gas->created_at)) }}</td>
                                <td>
                                    @if($gas->status == 2)
                                        <span style=color:#ff0000;font-weight:bold;>{{ "Price not set" }}</span>
                                    @else
                                        <span style=color:#006b06;font-weight:bold;>{{ "Price set" }}</span>
                                    @endif
                                </td>                                
                                <td>
                                    <div class="d-flex align-items-center list-action">

                                        <a class="mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Gas Opened Transaction"
                                            href="{{ url('sales/view_gas_opened_transaction/'.$gas->new_product_id )}}"><i class="far fa-eye text-orange" style="font-size:20px;"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="mr-2" data-toggle="modal" data-target="#openGas{{ $gas->id }}" data-backdrop="static" data-placement="top" title="Open New Gas" data-original-title="Open New Gas"
                                            href="#"><i class="fas fa-pen text-blue" style="font-size:20px;"></i></a>
                                        
                                    </div>
                                </td>
                            </tr> 
                            
                            @include('layouts.sales.stocks.modal.opengas')
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Created By</th>
                            <th>Date Created</th>
                            <th>Price Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

  @include('layouts.sales.stocks.modal.creategas')
@endsection