@extends('layouts.salesLayout.sales_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details of Previous Expenses Made</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon far fa-circle text-blue"> </i> Details of Previous Expenses Made</h4>
                </div>
                <!-- <a class="btn btn-sm btn-primary btn-round ml-auto" href="{{ url('sales/lowstockrequest') }}">
                    <i class="fas fa-eye"></i>
                    View Requests
                </a> -->
            </div>
           
            <div class="card-body">
                <h5><center>Please select the date to display the expenses.</center></h5><br><br><br>
            <div >

                <form class="row " action="{{ url('sales/previous_expenses') }}" method="POST">@csrf
                    <div class="col-6 select2-input" style="display:inline-flex">
                            <label class="col-5" for="transactionDate" style="padding-top:10px;font-weight:bolder;text-align:right">Select Date</label>
                            <!-- Date Picker Input -->
                            <div class="form-group mb-4" style="width:100%">
                                <div class="input-group p-0 shadow-sm" >
                                    <input type="text" placeholder="Choose an expense date" class="form-control" data-date-end-date="0d" id="transactionDate" name="expenseDate" autocomplete="off" required>
                                    <div class="input-group-append"><span class="input-group-text px-4"><i class="fas fa-calendar-alt"></i></span></div>
                                </div>
                            </div>
                        <!-- End of Date Picker Input -->
                    </div>

                    <div class="col-4"  style="margin-left:0px;">
                        <button type="submit" class="btn btn-sm btn-primary mb-2" data-toggle="tooltip" data-placement="top" data-original-title="Show Expenses" title="Show Expenses" style="width:90px;height:40px;font-size:16px"> Show</button>
                    </div>
                </form>
                <!-- End of Form -->
                <br><br>
            </div>
            @if(!empty($expensedate->expense_date))
                <h3><center>Expenses Made As At <strong>{{ date("jS F, Y ", strtotime( $expensedate->expense_date )) }}</strong></center></h3>
            @else
                <h4><center><span style="color:#ff0000">Sorry, there was no expenses made on this day.</span> &nbsp;&nbsp; Please select another date.</center></h4>
            @endif

            @if(!empty($expensetrans))

              <div class="table-responsive ">
                <table id="lowstocks" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Description</th>
                            <th>Amount (GHC)</th>
                            <th>Date of Expenses</th>
                            <th>Made By</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($expensetrans as $expen)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $expen->description }}</td>
                                <td>{{ number_format($expen->amount,2) }}</td>
                                <td>{{ date("jS F, Y H:i:s",strtotime($expen->created_at)) }}</td>
                                <td>{{ $expen->user->name }}</td>
                                <td>
                                    @if( $expen->status == 1)
                                        {{ " Debited " }}
                                    @else 
                                        {{ " Not Debited " }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Description</th>
                            <th>Amount (GHC)</th>
                            <th>Date of Expenses</th>
                            <th>Made By</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @endif
            </div>
      </div>
    </div>
              


@endsection