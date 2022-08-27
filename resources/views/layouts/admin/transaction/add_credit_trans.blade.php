@extends('layouts.adminLayout.admin_design')
@section('content')




<?php 
    use App\Models\MainWarehouse;
    use App\Models\TempTrans;
    use App\Models\Customers;


    $mainwarehouseproduct = MainWarehouse::mainwarehouseproduct();
    // echo "<pre>"; print_r($mainwarehouseproduct); die; 


    
    $gettemporaltrans = TempTrans::gettemporaltrans();
    // echo "<pre>"; print_r($gettemporaltrans); die;
    

    $calsum = TempTrans::calsum();
    // echo "<pre>"; print_r($calsum); die; 

    $allTotal = 0;
    foreach ($calsum as $getsum) {

            $newprx = (($getsum->mainwarehouse->prodcost) - ($getsum->discount));

            $total = ($getsum->qty * $newprx);
            $allTotal +=  $total;
    }



    
    $getbigcustomers = Customers::getbigcustomers();
    // dd($getbigcustomers); die;

    // $insertid = $getcustomers->id;
    // dd($insertid); die;

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
                        <h5 class="card-title"> <i class="fas fa-user text-green"> </i> New Credit Sales Transaction</h5>
                    </div>
                    </div>
                        <div class="card-body">

                        <h6 class="card-subtitle text-muted text-red">Perform New Credit Sales Transaction</h6><br><br>
                            <div >

                                <form class="row " action="{{ url('admin/credit_transaction/'.$insertid) }}" method="POST">@csrf
                                    <div class="col-6 select2-input" style="display:inline-flex">
                                        <label class="col-5" for="productname" style="padding-top:10px;font-weight:bolder;text-align:right">Product Name</label>
                                        <select class="form-control selectpicker col-9" name="productid" id="productid" style="z-index: 99;" required>
                                            <option value="">*** Select Product ***</option>

                                            @foreach($mainwarehouseproduct as $product)
                                                <option value="{{ $product['id'] }}">{{ $product['main_product_name'] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Available Qty ({{ $product['newprod_qtyctn'] }}) </option>
                                            @endforeach
                                        </select>
                                        <!-- <input type="hidden" class="form-control" name="branchid" id="branchid" value="" required> -->
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
                                    
                                
                                @foreach($gettemporaltrans as $trans)
                                        
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $trans->mainwarehouse->main_product_name }}</td>
                                        <td>{{ $trans->qty }}</td>
                                        <td>{{ number_format($trans->mainwarehouse->prodcost, 2) }}</td>
                                        <td>{{ number_format($trans->discount, 2) }}</td>
                                        <td>{{ number_format(($trans->mainwarehouse->prodcost - $trans->discount), 2) }}</td>
                                        <td>{{ number_format((($trans->mainwarehouse->prodcost - $trans->discount)*($trans->qty)), 2) }} </td>
                                    
                                        <td style="text-align: center;">
                                            
                                            <a href="#updateCreditDiscount" title="Give Discount" data-target="#updateCreditDiscount{{ $trans->id }}" data-toggle="modal"  data-backdrop="static"><i class="far fa-edit fa-spin text-green"></i></a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#updateCreditQty" title="Change Qty (PCS)" data-target="#updateCreditQty{{ $trans->id }}" data-toggle="modal"  data-backdrop="static"><i class="fas fa-pen fa-spin text-blue"></i></a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#delete" title="Delete Product" data-target="#deleteCreditTrans{{ $trans->id }}" data-toggle="modal"  data-backdrop="static"><i class="fas fa-trash text-red"></i></a>
                                                 
                                        </td>
                                    </tr> 
                                    

                                    <!-- Update Qty Transaction Detail -->
                                    @include("layouts.admin.transaction.modal.credit_qty_trans")
                                    <!-- Update Qty Transaction Detail -->



                                    <!-- Update Discount Transaction Detail -->
                                    @include("layouts.admin.transaction.modal.credit_discount_trans")
                                    <!-- Update Discount Transaction Detail -->



                                    
                                    <!-- Delete One Transaction Detail -->
                                    @include("layouts.admin.transaction.modal.credit_delete_trans")
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
                        <h5 class="card-title"><i class="fas fa-user text-green"> </i> Payment Details</h5>
                        <!-- <h6 class="card-subtitle text-muted">Single horizontal row.</h6> -->
                    </div>
                            
                    <div class="card-body">
                        <form class="row row-cols-md-auto align-items-center"  action="{{ url('admin/complete_credit_transaction/'.$insertid) }}" method="post">@csrf
                            <input type="hidden" class="form-control" id="insertid" name="insertid" value="{{ $insertid }}"/>
                            <!-- @foreach($gettemporaltrans as $trans)
                                <input type="hidden" class="form-control" id="productid" name="productid[]" value="{{ $trans->mainwarehouse->id }}"/>
                            @endforeach -->
                            <div class="col-12">
                                <label class="" for="creditsubTotal">Sub Total (GHC)</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 disabled" id="creditsubTotal" name="creditsubTotal" value="{{ $allTotal ?? 0.00 }}" placeholder="0.00" disabled style="text-align:right;color:#111111">
                                
                                <input type="hidden" class="form-control" id="creditsubTotalValue" name="creditsubTotalValue" value="{{ $allTotal ?? 0.00 }}"/>                        
                            </div>

                            
                        
                            <div class="col-12"> 
                                <label class="" for="discount">Discount (GHC)</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" id="creditDiscount" name="creditDiscount" onkeyup="discountFunc()" min="0.00" placeholder="0.00" style="text-align:right;color:#111111"   autocomplete="off">
                            </div>


                            <div class="col-12">
                                <label class="" for="creditgrandTotal">Grand Total (GHC)</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 disabled" id="creditgrandTotal" name="creditgrandTotal"  placeholder="0.00" disabled style="text-align:right;color:#111111">
                                
                                <input type="hidden" class="form-control" id="creditgrandTotalValue" name="creditgrandTotalValue" />                        
                            </div>

                            <div class="col-12">
                                <label class="" for="partPayment">Part Payment (GHC)</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="text" class="form-control" id="partpay" name="partpay" onkeyup="creditpartpayAmount()"  autocomplete="off" placeholder="0.00" min="0.00" style="text-align:right;color: #111111;" />
                                </div>
                            </div>

                            <div class="col-12"> 
                                <label class="" for="amtdue">Amount Due (GHC)</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" id="amtdue" name="amtdue" min="0.00" placeholder="0.00" disabled style="text-align:right;color:#111111">
                                <!-- <input type="hidden" class="form-control" id="insertid" name="insertid" value=""/> -->
                                <input type="hidden" class="form-control" id="amtdueValue" name="amtdueValue" />                       
                            </div>

                            <div class="col-12">
                                <label for="payMethod">Payment Terms</label>
                                <select class="form-control" name="duration" id="duration" data-dependent="payDays">
                                    <option value="">*** Payment Terms ***</option>
                                    <!-- <option value="Yearly">Yearly</option> -->
                                    <option value="Monthly">Monthly</option>
                                    <option value="Weekly">Weekly</option>
                                    <!-- <option value="Daily">Daily</option> -->
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="payDays">Payable For (Duration)</label>
                                <select class="form-control" name="payDays" id="payDays">
                                    <option value="">*** Select Duration ***</option>
                                    <option value="1">1 Month</option>
                                    <option value="2">2 Months</option>
                                    <option value="3">3 Months</option>
                                    <option value="4">4 Months</option>
                                    <option value="5">5 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="21">21 Days</option>
                                </select>
                            </div>

                            <br><br><br><br>

                            <!-- Transaction Buttons -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-lg btn-primary mb-2" name="submitTransBtn" id="submitTransBtn" style="width:100%;font-size:15px"><i class="fas fa-check-double text-orange"> </i> Complete Transaction</button>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-lg btn-default mb-2" name="cancelCreditTrans" id="cancelTransModalBtn" data-toggle="modal" data-target="#cancelCreditTrans{{ $insertid }}" data-backdrop="false" style="width:100%;font-size:15px"><i class="fas fa-times text-red"> </i> Cancel Transaction</button>
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
    <div class="modal fade show" id="cancelCreditTrans{{ $insertid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="cancelCreditTrans"><i class="fas fa-trash text-red"></i> Cancel Transaction ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color: #ff0000;">×</span>
            </button>
            </div>

            <form action="{{ url('admin/cancel_credit_transaction/'.$insertid) }}" method="post">@csrf
                
            <div class="modal-body m-3">
            
                <p style="margin-bottom:0px">Are you sure you want to cancel this transaction ?</p>
                <small style="color: #ff0000;"> (Note that all records would be deleted.)</small>

                <input type="hidden" class="form-control" name="insertid" value="{{ $insertid }}" required>
                @foreach($gettemporaltrans as $trans)
                <input type="hidden" class="form-control" id="transid" name="transid" value="{{ $trans->id }}" required>
                @endforeach 
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