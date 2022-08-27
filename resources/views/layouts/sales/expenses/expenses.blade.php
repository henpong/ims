@extends('layouts.salesLayout.sales_design')
@section('content')




  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/stocks') }}"><i class="ri-user-line mr-1 float-left"></i>Product Stocking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daily Expenses</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Daily Expenses</h4>
                </div>
                <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addExpense" data-backdrop="static">
                    <i class="fas fa-plus"> </i> Add
                </button>
            </div>
           
            <div class="card-body">

            <p class="mb-0">This is where you make all DAILY EXPENSES.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="expense" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
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
                        @foreach($expenses as $expen)
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
            </div>
        
      </div>
    </div>
              



  <!-- Add Expenses -->
 <div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="addExpense" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExpense"><i class="fas fa-plus text-blue"></i> Make New Expenses</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #ff0000;">×</span>
                </button>
            </div>

            <form action="{{ url('sales/addexpense/' ) }}" method="post">@csrf

                <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                    <div class="col-12">
                        <label class="" for="productid">Description</label>
                        <div class="input-group mb-2 mr-sm-2">
                           <textarea class="form-control" name="description" id="description" cols="10" rows="5">

                           </textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="" for="amount">Amount (GHC)</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="amount" name="amount" autocomplete="off" placeholder="Enter Amount Given Out (GHC)" />
                        </div>
                    </div>


                    <!-- <div class="col-12">
                        <label class="" for="expensedate">Select Date of Expense</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="datepicker" name="expensedate" autocomplete="off" placeholder="Select Date" />
                        </div>
                    </div> -->



            </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                        <i class="fas fa-times text-white fa-spin"> </i> &nbsp;
                        Cancel
                    </button>
                    <button class="btn btn-sm btn-primary" type="submit" >
                        <i class="fas fa-paper-plane text-white"> </i> &nbsp;
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add Expenses -->

@endsection