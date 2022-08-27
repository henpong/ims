@extends('layouts.salesLayout.sales_design')
@section('content')




  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/stocks') }}"><i class="ri-user-line mr-1 float-left"></i>Stocks</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cash Book</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Cash In Hand</h4>
                </div>
                <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addCash" data-backdrop="static">
                    <i class="fas fa-plus"> </i> Add
                </button>
            </div>
           
            <div class="card-body">

            <p class="mb-0">This is where you enter all CASH at the end of the sales.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="expense" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Total Sales (GHC)</th>
                            <th>Total Expenses (GHC)</th>
                            <th>Cash In Hand (GHC)</th>
                            <th>Date of Sales</th>
                            <th>Entered By</th>
                            <th>Branch Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($cashbooks as $cash)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ number_format($cash->total_sales,2) }}</td>
                                <td>{{ number_format($cash->total_expenses,2) }}</td>
                                <td>{{ number_format($cash->total_cash,2) }}</td>
                                <td>{{ date("jS F, Y  H:i:s",strtotime($cash->created_at)) }}</td>
                                <td>{{ $cash->user->name }}</td>
                                <td>{{ $cash->branch->branch_name }}</td>
                                <td>
                                    @if( $cash->status == 1)
                                        {{ " Checked " }}
                                    @else 
                                        {{ " Not Checked " }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Total Sales (GHC)</th>
                            <th>Total Expenses (GHC)</th>
                            <th>Cash In Hand (GHC)</th>
                            <th>Date of Sales</th>
                            <th>Entered By</th>
                            <th>Branch Name</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              



@include('layouts.sales.cashbook.modal.add_cash')

@endsection