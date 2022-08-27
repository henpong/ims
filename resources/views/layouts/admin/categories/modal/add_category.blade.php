




<div class="modal fade add-user" id="addCategory"  data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="fas fa-home" > </i> Add New Category </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#ff0000">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('admin/add_edit_category')}}" name="categoryForm" id="categoryForm" enctype="multipart/form-data">@csrf
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter Category Name" @if(!empty($getCategoriesData['category_name'])) value="{{$getCategoriesData['category_name']}}" @else value="{{old('category_name')}}" @endif>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>                                  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label>Section</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="section_id" id="section_id" style="width: 100%;" @if(!empty($getBranchData['branch_colour'])) value="{{$getBranchData['branch_colour']}}" @else value="{{old('branch_colour')}}" @endif>
                                <option  value="">Select Section</option>
                                @foreach($getSections as $sections)
                                    <option value="{{$sections->id}}">{{$sections->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                  
                </div> 
                <div class="row">  
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <div id="appendCategoriesLevel" data-style="py-0">
                                @include('layouts.admin.categories.append_categories_level')
                            </div>
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