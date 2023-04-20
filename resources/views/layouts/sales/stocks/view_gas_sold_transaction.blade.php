@extends('layouts.salesLayout.sales_design')
@section('content')

  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/gas_pds') }}"><i class="ri-notification-line mr-1 float-left"></i>Gas Pounds</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gas Pounds (pds) - Transactions</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                <h4 class="card-title mb-3"><i class="nav-icon fas fa-home text-blue"> </i> Gas Pounds (pds) - Transactions</h4>
                </div>
            </div>
           
            <div class="card-body">

             <p class="mb-0">View all gas cylinders opened</p><br><br>

              <div class="table-responsive rounded mb-3">

              <!-- Display Product Name And Code Here  -->
              @if(!empty($getGasPdsOpenedName['id']))
                <legend>
                        <center>
                        <h2>
                            {{ $getGasPdsOpenedName['gas_pds_name'] }}   ----  {{ $getGasPdsOpenedName['product_code'] }}
                        </h2>
                        </center>
                </legend>
                @endif
                <table id="gasTransactions" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Opened By</th>
                            <th>Qty Opened (Cylns)</th>
                            <th>Weight(kg)</th>
                            <th>Total Qty (pds)</th>
                            <th>Date Opened</th>
                            <th>Branch</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($viewTransaction as $tans)
                        
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tans['name'] }}</td>
                            <td style="text-align:center">{{ $tans['qty_open'] }}</td>
                            <td style="text-align:center">{{ $tans['weight_pds'] }}</td>
                            <td style="text-align:center">{{ number_format(($tans['qty_open'] * $tans['weight_pds']),1) }}</td>
                            <td>{{ date("jS M., Y  H:i:s",strtotime($tans['date_open'])) }}</td>
                            <td>{{ $tans['branch_name'] }}</td>
                            <td>
                                <a href="javascript:void(0)" class="confirmDelete" record="gaspdsLogOpen" recordid="{{ $tans['id'] }}"><i class="fas fa-trash-alt text-red fa-spin" ></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Opened By</th>
                            <th>Qty Opened (Cylns)</th>
                            <th>Weight(kg)</th>
                            <th>Total Qty (pds)</th>
                            <th>Date Opened</th>
                            <th>Branch</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

@endsection