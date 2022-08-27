
<div class="modal fade add-user" id="addBank"  data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="fas fa-home" > </i> Add New Bank Account Details </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#ff0000">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('admin/add_edit_bank')}}" name="bankForm" id="bankForm" enctype="multipart/form-data">@csrf
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="bankName">Bank Name</label>
                            <input type="text" class="form-control" id="bankName" name="bankName" placeholder="Enter Bank's Name">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label> Account Name</label>
                            <input type="text" class="form-control" id="acName" name="acName" placeholder="Enter Account Name">
                        </div>
                    </div>                                  
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="categoryDiscount">Account Number</label>
                            <input type="text" class="form-control" id="acNomba" name="acNomba" placeholder="Enter Account Number">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="branch">Branch </label>
                            <input type="text" class="form-control" id="branch" name="branch" placeholder="Enter Account Branch">
                        </div>
                    </div>                                     
                </div>
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="actype">Account Type</label>
                            <input type="text" class="form-control" id="actype" name="actype" placeholder="Enter Account Type">
                            <div class="help-block with-errors"></div>
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