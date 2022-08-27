@extends('layouts.salesLayout.sales_design')
@section('content')



<?php 
    use App\TempTrans;
    use App\Customers;
    use App\Products;


    $getproducts = Products::getproducts();
    // echo "<pre>"; print_r($gettemptrans); die; 

    $getcustomers = Customers::getcustomers();
    // dd($getcustomers); die;

    $insertid = $getcustomers->id;
    // dd($insertid); die;

    $gettemptrans = TempTrans::gettemptrans();

    // $gettemptransid = TempTrans::gettemptransid();

    // echo "<pre>"; print_r($gettemptrans); die; 

    $sum = TempTrans::sum();
    // echo "<pre>"; print_r($sum); die; 
 
    $allTotal = 0;
    foreach ($sum as $getsum) {
        if(($getsum->qty) >= ($getsum->product->wholesale_qty)){
            $newprx = (($getsum->product->product_wholesale_price) - ($getsum->discount));

            $total = ($getsum->qty * $newprx);
            $allTotal +=  $total;
        }else {
            
            $newprx = (($getsum->product->product_price) - ($getsum->discount));

            $total = ($getsum->qty * $newprx);
            $allTotal +=  $total;
        }
    }


?>





    <!-- <div class="row"> -->
        <div class="col-md-12" style="display:inline-flex">
            <div class="col-md-9">
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
                        <h5 class="card-title"> <i class="fas fa-user text-green"> </i> New Temporal Creditor Sales Transaction</h5>
                    </div>
                    </div>
                        <div class="card-body">

                        <h6 class="card-subtitle text-muted text-red">Perform New Temporal Creditor Sales Transaction</h6><br><br>
                            <div >

                                <form class="row " action="{{ url('sales/add_transaction/'.$insertid) }}" method="POST">@csrf
                                    <div class="col-6 select2-input" style="display:inline-flex">
                                        <label class="col-5" for="productname" style="padding-top:10px;font-weight:bolder;text-align:right">Product Name</label>
                                        <select class="form-control selectpicker select2 col-9" name="productid" id="productid" style="z-index: 99;" required style="width:100%">
                                            <option value="">*** Select Product ***</option>

                                            @foreach($getproducts as $product)
                                                <option value="{{ $product['id'] }}">{{ $product['product_name'] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Available Qty ({{ $product['product_qty'] }}) </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" class="form-control" name="branchid" id="branchid" value="{{ $product['branch_id'] }}" required>
                                        <input type="hidden" class="form-control" name="insertid" id="insertid" value="{{ $insertid }}" required>
                                    </div>

                                    <div class="col-3" style="display:inline-flex">
                                        <label class="col-5" for="qty" style="padding-top:10px;margin-left:10px;font-weight:bolder;text-align:right">Qty</label>
                                        <div class="input-group mb-2  col-6" style="margin-right:5px">
                                            <input type="text" class="form-control" id="qty" name="qty" value="1" min="1" step="any" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-2"  style="margin-left:0px;">
                                        <button type="submit" class="btn btn-sm btn-primary mb-2" title="Add New Product" style="width:90px;height:40px;font-size:15px"><i class="fas fa-plus"></i> Add</button>
                                    </div>
                                </form>
                                <!-- End of Form -->
                                <br><br>
                            </div>



                        <!-- Display Table -->
                        <div class="table-responsive rounded mb-3">
                            <table id="transTable" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>No.</th>
                                        <th>Product Name</th>
                                        <th>Qty(pcs)</th>
                                        <th>U.Price(GHC)</th>
                                        <th>Disc(GHC)</th>
                                        <th>N.Price(GHC)</th>
                                        <th>Sub Tot(GHC)</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody class="ligth-body">
                                    
                                
                                @foreach($gettemptrans as $trans)
                                        
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $trans->product->product_name }}</td>
                                        <td>{{ $trans->qty }}</td>
                                        <td>
                                            @if($trans->qty >= $trans->product->wholesale_qty)
                                                {{ number_format($trans->product->product_wholesale_price, 2) }}
                                            @else 
                                                {{ number_format($trans->product->product_price, 2) }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($trans->discount, 2) }}</td>
                                        <td>
                                            @if($trans->qty >= $trans->product->wholesale_qty)
                                                {{ number_format(($trans->product->product_wholesale_price - $trans->discount), 2) }}
                                            @else 
                                                {{ number_format(($trans->product->product_price - $trans->discount), 2) }}
                                            @endif
                                        </td>
                                        <td>
                                            
                                            @if($trans->qty >= $trans->product->wholesale_qty)
                                                {{ number_format((($trans->product->product_wholesale_price - $trans->discount)*($trans->qty)), 2) }}
                                            @else 
                                                {{ number_format((($trans->product->product_price - $trans->discount)*($trans->qty)), 2) }}
                                            @endif

                                        </td>
                                    
                                        <td style="text-align: center;">
                                            <a href="#updateTempDiscount" title="Give Discount" data-target="#updateTempDiscount{{ $trans->id }}" data-toggle="modal"  data-backdrop="false"><i class="far fa-edit fa-spin text-green"></i></a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#updateTempQty" title="Change Qty (PCS)" data-target="#updateTempQty{{ $trans->id }}" data-toggle="modal"  data-backdrop="false"><i class="fas fa-pen fa-spin text-blue"></i></a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#delete" title="Delete Product" data-target="#deleteTempTrans{{ $trans->id }}" data-toggle="modal"  data-backdrop="false"><i class="fas fa-trash text-red"></i></a>
                                                
                                        </td>
                                    </tr> 
                                    

                                    <!-- Update Qty Transaction Detail -->
                                    @include("layouts.sales.transaction.modal.temp_qty_trans")
                                    <!-- Update Qty Transaction Detail -->



                                    <!-- Update Discount Transaction Detail -->
                                    @include("layouts.sales.transaction.modal.temp_discount_trans")
                                    <!-- Update Discount Transaction Detail -->



                                    
                                    <!-- Delete One Transaction Detail -->
                                    @include("layouts.sales.transaction.modal.temp_delete_trans")
                                    <!-- Delete One Transaction Detail -->


                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        </div>
                    </div>
            </div>


            <!-- Cash Sales Transaction -->
            <div class="col-md-3">
                <!-- Display Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger" style="margin:20px;width:30%;">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif


                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-user text-green"> </i> Cash Sales Transaction</h5>
                        <!-- <h6 class="card-subtitle text-muted">Single horizontal row.</h6> -->
                    </div>
                            
                    <div class="card-body">
                        <form id="autoSumForm" class="row row-cols-md-auto align-items-center"  action="{{ url('sales/complete_temp_transaction/'.$insertid) }}" method="post">@csrf
                            <!-- <input type="hidden" class="form-control" id="insertid" name="insertid" value="{{ $insertid }}"/> -->
                            
                            <!-- <input type="hidden" class="form-control" id="productid" name="productid" value=""/> -->
                            

                            <div class="col-12">
                                <label class="" for="subTotal">Grand Total (GHC)</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 disabled" id="subTotal" name="subTotal" value="{{ $allTotal ?? 0.00 }}" placeholder="0.00" disabled style="text-align:right;color:#111111">
                                
                                <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="{{ $allTotal ?? 0.00 }}"/>                        
                            </div>


                            <br><br><br><br><br>

                            <!-- Transaction Buttons -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-lg btn-primary mb-2" name="submitTransBtn" id="submitTransBtn" style="width:100%;font-size:15px"><i class="fas fa-paper-plane text-orange"> </i> Complete Transaction</button>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-lg btn-default mb-2" name="cancelTempTrans" id="cancelTempTransModalBtn" data-toggle="modal" data-target="#cancelTempTrans{{ $insertid }}" data-backdrop="false" style="width:100%;font-size:15px"><i class="fas fa-times text-red"> </i> Cancel Transaction</button>
                            </div>
                            <!-- End of Transaction Buttons -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- End of Cash Sales Transaction -->

        </div>
    <!-- </div> -->




    
 <!-- /Delete All Transaction Details -->
<div class="modal fade show" id="cancelTempTrans{{ $insertid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash text-red"></i> Cancel Transaction ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: #ff0000;">×</span>
        </button>
        </div>

        <form action="{{ url('sales/cancel_temp_transaction/'.$insertid) }}" method="post">@csrf
            
        <div class="modal-body m-3">
        
            <p style="margin-bottom:0px">Are you sure you want to cancel this transaction ?</p>
            <small style="color: #ff0000;"> (Note that all records would be deleted.)</small>

            <input type="hidden" class="form-control" name="insertid" value="{{ $insertid }}" required> 
            <input type="hidden" class="form-control" id="transid" name="transid" value="" required> 
        </div>

        <div class="modal-footer">
            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                <i class="fas fa-times text-red fa-spin"> </i> &nbsp;&nbsp;
                No, Go Back
            </button>
            <button class="btn btn-sm btn-primary" type="submit" >
                <i class="fas fa-paper-plane text-orange"> </i> &nbsp;&nbsp;
                Yes, Cancel
            </button>
            <!-- <a class="btn btn-sm btn-primary" href="#">
                <i class="fas fa-paper-plane text-orange"> </i> &nbsp;&nbsp;
                Yes, Cancel
            </a> -->
        </div>
        </form>

    </div>
    </div>
</div>
<!-- /Delete All Transaction Details -->



@endsection