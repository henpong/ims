

<?php
    use App\Models\Branches;

    $branches = Branches::getbranches();

?>



<div class="modal fade" id="addAdminUser"  data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="fas fa-user-plus" > </i> Add New Admin </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#ff0000">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('admin/add_edit_admin')}}" name="userForm" id="userForm" enctype="multipart/form-data">@csrf
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="productName"> Role</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="role" id="role" style="width:100%">
                                <option value="" >*** Select User Role ***</option>
                                <option value="Administrator"> Administrator</option>
                            </select>
                        </div>
                    </div>                                  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="wholeQTY">Full Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Full Name" autocomplete="off">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                  
                </div>  
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label> Branch Name</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="branchid" id="branchid" style="width:100%">
                                <option value="" >Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" autocomplete="off">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter User Password" autocomplete="off">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" autocomplete="off">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter User Phone Number" autocomplete="off">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="userImage">User Image</label>
                            <div class="input-group mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="userImage" id="userImage">
                                    <label class="custom-file-label" for="userImage">Choose file</label>
                                </div>                             
                            </div>
                            <small style="color:#ff0000">(Recommended Image size: 60x60)</small>
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