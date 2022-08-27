
<div class="modal fade add-user" id="addBranch"  data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="fas fa-home" > </i> Add New Branch </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#ff0000">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('admin/add_edit_branches')}}" name="userForm" id="userForm" enctype="multipart/form-data">@csrf
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label>Branch Name *</label>
                                <input type="text" class="form-control" id="branchName" name="branchName" placeholder="Enter Branch Name" @if(!empty($getBranchData['branch_name'])) value="{{$getBranchData['branch_name']}}" @else value="{{old('branch_name')}}" @endif>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label>Branch Colour *</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="branchColour" id="branchColour" style="width: 100%;" @if(!empty($getBranchData['branch_colour'])) value="{{$getBranchData['branch_colour']}}" @else value="{{old('branch_colour')}}" @endif>
                                <option value="" @if(isset($getBranchData['branch_colour'])) selected @endif>Select Colour</option>
                                <option value="RED">RED</option>
                                <option value="YELLOW">YELLOW</option>
                                <option value="GREEN">GREEN</option>
                                <option value="BLUE">BLUE</option>
                                <option value="PINK">PINK</option>
                                <option value="NONE">NONE</option>
                            </select>
                        </div>
                    </div>                                  
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" id="branchPhone" name="branchPhone" placeholder="Enter Phone Number" @if(!empty($getBranchData['branch_contact'])) value="{{$getBranchData['branch_contact']}}" @else value="{{old('branch_contact')}}" @endif>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                     
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="branchAddress">Branch Address</label>
                            <textarea class="form-control" rows="3" name="branchAddress" id="branchAddress" placeholder="Enter Branch Address">
                                @if(!empty($getBranchData['branch_address'])) {{$getBranchData['branch_address']}} @else {{old('branch_address')}} @endif
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