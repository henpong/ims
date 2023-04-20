@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-4-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Spoilt Goods From Shops</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-sync-alt text-red"> </i> Spoilt Goods From Shops</h4>
                     </div>
                  </div>
           
            <div class="card-body">

             <p class="mb-0">This is where you CHECK spoilt goods entered by users.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="stockrequest" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty (pcs) <br>Entered</th>
                            <th>Price (GHC)</th>
                            <th>Product Condition</th>
                            <th>Description</th>
                            <th>Date Entered</th>
                            <th>Entered By</th>
                            <th>Branch Name</th>
                            <th>Check Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody >
                      @foreach($spoiltgoods as $goods)
                            <tr >
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                        <label for="checkdelete" class="mb-0"></label>
                                    </div>
                                </td>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $goods->products->product_code }}</td>
                                  <td>{{ $goods->products->product_name }}</td>
                                  <td style="text-align:center">{{ $goods->qty_spoilt }}</td>
                                  <td style="text-align:right">{{ number_format($goods->products->product_price,2) }}</td>
                                  <td>{{ $goods->condition }}</td>
                                  <td>{{ $goods->description }}</td>
                                  <td>{{ date("jS F, Y  H:i:s", strtotime($goods->spoilt_date)) }}</td>
                                  <td>{{ $goods->user->name }}</td>
                                  <td>{{ $goods->branch->branch_name }}</td>
                                  <td>
                                    @if( $goods->check_status == 1)
                                        <span style=color:#FF0000;font-weight:bold;>{{ "Not Checked" }}</span>
                                    @elseif( $goods->check_status == 3)
                                        <span style=color:#4091d7;font-weight:bold;>{{ "Rejected" }}</span>
                                    @else
                                        <span style=color:#006b06;font-weight:bold;>{{ "Checked" }}</span>
                                    @endif
                                  </td>
                                  <td style="text-align:center">
                                    @if( $goods->check_status == 1)
                                      <div class="d-flex align-items-center list-action">
                                          <a  data-toggle="modal" data-placement="top" title="Take Decision" data-original-title="Edit"
                                              href="#checkSpoiltGoodsRequest{{$goods->id}}" data-target="#checkSpoiltGoodsRequest{{$goods->id}}" data-request_id="{{ $goods->id }}" data-request_status="{{ $goods->check_status }}" data-product_id="{{ $goods->product_id }}" data-branch_id="{{ $goods->branch_id }}"><i class="fas fa-pencil-alt mr-0" style="font-size:20px;padding-top:1px;"></i></a>
                                          
                                      </div>
                                      
                                    @endif
                                  </td>
                              </tr>

                              @include('layouts.admin.stocks.modal.check_spoilt_goods')

                          @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty (pcs) <br>Entered</th>
                            <th>Price (GHC)</th>
                            <th>Product Condition</th>
                            <th>Description</th>
                            <th>Date Entered</th>
                            <th>Entered By</th>
                            <th>Branch Name</th>
                            <th>Check Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

  
@endsection