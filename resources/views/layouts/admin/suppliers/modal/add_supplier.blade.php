


<div class="modal fade " id="addSupplier"  data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="fas fa-user-plus" > </i> Add New Supplier </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#ff0000">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('admin/add_edit_supplier')}}" name="userForm" id="userForm" enctype="multipart/form-data">@csrf
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="supplierName">Supplier Name</label>
                            <input type="text" class="form-control" id="supplierName" name="supplierName" placeholder="Enter Supplier Name" @if(!empty($getSupplierData['supplier_name'])) value="{{$getSupplierData['supplier_name']}}" @else value="{{old('supplier_name')}}" @endif>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                        <label> Supplier Country</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="supplierCountry" id="supplierCountry" style="width: 100%;">
                                <option value="" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "") selected @endif >Select Country</option>
                                <option value="CHINA" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "CHINA") selected @endif >China</option>
                                <option value="GHANA" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "GHANA") selected @endif >Ghana</option>
                                <option value="NIGERIA" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "NIGERIA") selected @endif >Nigeria</option>
                                <option value="SENEGAL" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "SENEGAL") selected @endif >Senegal</option>
                                <option value="INDIA" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "INDIA") selected @endif >India</option>
                                <option value="USA" @if(isset($getSupplierData['supplier_country']) && $getSupplierData['supplier_country'] == "USA") selected @endif >USA</option>
                            </select>
                        </div>
                    </div>                                  
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="categoryDiscount">Phone Number</label>
                            <input type="text" class="form-control" id="supplierPhone" name="supplierPhone" placeholder="Enter Phone Number" @if(!empty($getSupplierData['supplier_contact'])) value="{{$getSupplierData['supplier_contact']}}" @else value="{{old('supplier_contact')}}" @endif>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="branchAddress">Supplier Address</label>
                            <textarea class="form-control" rows="3" name="supplierAddress" id="supplierAddress" placeholder="Enter Supplier Address">
                                @if(!empty($getSupplierData['supplier_address']))  {{$getSupplierData['supplier_address'] }} @else  {{ old('supplier_address') }} @endif
                            </textarea>
                        </div>
                    </div>                                     
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger mr-10"><i class="fas fa-sync"></i>Reset</button>
                <button type="button" class="btn btn-secondary mr-10" data-dismiss="modal"> <i class="fas fa-times"> </i> Close</button>
                <button type="submit" class="btn btn-primary"> <i class="fas fa-paper-plane"> </i> Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>