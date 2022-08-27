




<div class="modal fade add-brand" id="addBrand"  data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="fas fa-plus" > </i> Add New Brand </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#ff0000">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('admin/add_edit_brands')}}" name="brandsForm" id="brandsForm" enctype="multipart/form-data" data-toggle="validator">@csrf 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label>Brand Name </label>
                            <input type="text" class="form-control" id="brandName" name="brandName" placeholder="Enter Brand Name">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Description </label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Brand Description">
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