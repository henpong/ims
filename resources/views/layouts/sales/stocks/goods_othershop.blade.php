@extends('layouts.salesLayout.sales_design')
@section('content')
 
<?php
    use Illuminate\Support\Facades\Auth;
    use App\SpoiltGoods;
    // use App\Customers;

    $getproducts = SpoiltGoods::getproducts();
    // dd($getproducts); die;
?>



<div class="page-header">
    <h4 class="page-title">Goods to other shop</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{url('sales/dashboard')}}">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
                List of Goods Sold to Other Shop
        </li>
        
    </ul>
</div>
        

<div class="row">
    <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List of Goods Sold to Other Shop </h4>
                        <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#goodShop" data-backdrop="false">
                            <i class="fas fa-plus"></i>
                            Add
                        </button> 
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table id="goodshop" class="table table-striped table-hover table-bordered table-condensed" >
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Qty Sold (pcs)</th>
                                    <th>Unit Price (GHC)</th>
                                    <th>Total Amt (GHC)</th>
                                    <th>Sold To</th>
                                    <th>Sold By</th>
                                    <th>Date Sold</th>
                                    <th>Status</th>
                                    <th>Payment Received By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($goodshop as $shop)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $shop->products->product_code }}</td>
                                        <td>{{ $shop->products->product_name }}</td>
                                        <td>{{ $shop->goods_qty }}</td>
                                        <td>{{ number_format($shop->unit_price,2) }}</td>
                                        <td>{{ number_format($shop->total_amt,2)}}</td>
                                        <td>{{ $shop->cust_name }}</td>
                                        <td>{{ $shop->user->name }}</td>
                                        <td>{{ date("jS F, Y ",strtotime($shop->goods_date)) }}</td>
                                        <td>
                                            @if($shop->status == 1)
                                                <span class='label label-danger' style="color:#ff0000;font-weight:bolder">NOT PAID</span>
                                            @else
                                                <span class='label label-success' style="color:#006400;font-weight:bolder">PAID</span>
                                            @endif
                                        </td>
                                        <td>{{ $shop->receivedby }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Qty Sold (pcs)</th>
                                    <th>Unit Price (GHC)</th>
                                    <th>Total Amt (GHC)</th>
                                    <th>Sold To</th>
                                    <th>Sold By</th>
                                    <th>Date Sold</th>
                                    <th>Status</th>
                                    <th>Payment Received By</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>



 
<!-- Add Expenses -->
 <div class="modal fade" id="goodShop" tabindex="-1" role="dialog" aria-labelledby="goodShop" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goodShop"><i class="fas fa-plus text-blue"></i> SELL GOODS TO OTHER SHOP/CUSTOMER (S)</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #ff0000;">×</span>
                </button>
            </div>

            <form action="{{ url('sales/addgoods/' ) }}" method="post">@csrf

                <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                    <div class="col-12">
                        <label class="" for="productid">Product Name</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <select class="form-control" name="productid" id="productid">
                                <option value="">*** Select Product ***</option>
                                @foreach($getproducts as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-12">
                        <label class="" for="qtysold">Quantity Sold (PCS)</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="qtysold" name="qtysold" autocomplete="off" placeholder="Enter Quantity Sold (PCS)" />
                        </div>
                    </div>


                    <div class="col-12">
                        <label class="" for="cusname">Customer Sold To</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" class="form-control" id="cusname" name="cusname" autocomplete="off" placeholder="Enter Customer's Name" />
                        </div>
                    </div>



            </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                        <i class="fas fa-times text-white fa-spin"> </i> &nbsp;&nbsp;
                        Cancel
                    </button>
                    <button class="btn btn-sm btn-primary" type="submit" >
                        <i class="fas fa-paper-plane text-white"> </i> &nbsp;&nbsp;
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add Expenses -->


@endsection