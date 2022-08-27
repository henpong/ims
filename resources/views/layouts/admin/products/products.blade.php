@extends('layouts.adminLayout.admin_design')
@section('content')

<?php

use App\Models\Products;
use App\Models\Branches;

$mainwarehouseproduct = Products::mainwarehouseproduct();
$branches = Branches::getbranches();

?>

  <div class="col-sm-6 "> 
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/sections') }}"><i class="ri-notification-line mr-1 float-left"></i>Sections</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}"><i class="ri-notification-line mr-1 float-left"></i>Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-home text-blue"> </i> Products</h4>
                     </div>
                     <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target="#AddProduct" title="Add Product In Various Branch"><i class="fas fa-plus"> </i> Add</button>
                     <!-- <a href="{{url('/admin/add_edit_products_in_branches')}}" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target=".update-product" data-toggle="tooltip" data-placement="top" data-original-title="Add New Product In Branch"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">You can ADD and View all PRODUCTS</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="products" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
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
                            <th>Category Name</th>
                            <th>Qty(pcs) Left</th>
                            <th>Whole. Qty(pcs)</th>
                            <th>Whole. Price(GHS)</th>
                            <th>Unit Price(GHS)</th>
                            <th>Branch Name</th>
                            <th>Low Stock</th>
                            <th>Warehouse</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                    @foreach($products as $product)
                      <tr >
                          <td>
                              <div class="checkbox d-inline-block">
                                  <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                  <label for="checkdelete" class="mb-0"></label>
                              </div>
                          </td>
                          
                          <td>{{$loop->iteration}}</td>
                          <td>{{$product->product_code}}</td>
                          <td>{{$product->product_name}}</td>
                          <td>{{$product->category->category_name}}</td>
                          <td>{{$product->product_qty}}</td>
                          <td>{{$product->wholesale_qty}}</td>
                          <td>{{number_format($product->product_wholesale_price,2)}}</td>
                          <td>{{number_format($product->product_price,2)}}</td>
                          <td>{{$product->branch->branch_name}}</td>
                          <td>{{$product->lowstock_point}}</td>
                          <td>{{$product->warehousename->name}}</td>
                          <td>@if($product->status==1)
                                <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)" style="color:#007bff">Active</a>
                              @else
                                <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)" style="color:#ff0000">Inactive</a>
                              @endif
                          </td>
                          <td>
                          <div class="d-flex align-items-center list-action">
                              <a class="mr-3" data-toggle="tootip" data-placement="top" title="Update Product" data-original-title="Update Product" href="{{ url('admin/add_edit_products_in_branches/'.$product->id ) }}"><i class="far fa-edit text-blue" style="font-size:20px;"></i></a>
                              <a class="confirmDelete ml-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Product"
                                  href="javascript:void(0)" record="product" recordid="{{ $product->id }}"><i class="fas fa-trash-alt mr-0 text-red" style="font-size:20px;"></i></a>
                          </div>

                           
                          </td>
                        </tr>


                        <!-- UPDATE PRODUCT -->
                        @include('layouts.admin.products.modal.update_product')

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
                            <th>Category Name</th>
                            <th>Qty(pcs) Left</th>
                            <th>Whole. Qty(pcs)</th>
                            <th>Whole. Price(GHS)</th>
                            <th>Unit Price(GHS)</th>
                            <th>Branch Name</th>
                            <th>Low Stock</th>
                            <th>Warehouse</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              




@include('layouts.admin.products.modal.add_product')
@endsection