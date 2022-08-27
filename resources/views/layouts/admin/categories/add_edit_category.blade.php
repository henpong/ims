@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/branches') }}"><i class="ri-home-4-line mr-1 float-left"></i>Branches</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}"><i class="ri-home-4-line mr-1 float-left"></i>Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add & Edit Categories</li>
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
                        <h4 class="card-title mb-3">@if(empty($getCategoriesData['id'])) <i class="fas fa-plus" > </i> {{ $title }}  @else <i class="fas fa-pen" > </i> {{ $title }}  @endif</h4>
                     </div>
                     
                  </div>
           
            <div class="card-body">

             <form method="POST" @if(empty($getCategoriesData['id'])) action="{{url('admin/add_edit_category')}}" @else action="{{url('admin/add_edit_category/'.$getCategoriesData['id'])}}" @endif name="categoryForm" id="categoryForm" enctype="multipart/form-data">@csrf
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                                <label for="categoryName">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter Category Name" @if(!empty($getCategoriesData['category_name'])) value="{{$getCategoriesData['category_name']}}" @else value="{{old('category_name')}}" @endif>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>                                  
                      <div class="col-sm-6">                      
                        <div id="appendCategoriesLevel" data-style="py-0">
                          @include('layouts.admin.categories.append_categories_level')
                        </div>
                      </div>                                  
                  </div> 
                  <div class="row">  
                      <div class="col-sm-6">                      
                          <div class="form-group">
                            <label> Sections</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="section_id" id="section_id" style="width:100%">
                                  <option  value="">Select Section</option>
                                  @foreach($getSections as $sections)
                                      <option value="{{$sections->id}}">{{$sections->name}}</option>
                                  @endforeach
                            </select>
                          </div>
                      </div>                                     
                  </div> 
                  <button type="reset" class="btn btn-danger">Reset</button>                           
                  <button type="submit" class="btn btn-success mr-2" ><i class="fas fa-paper-plane"></i>Submit</button>
             </form>

            </div>
        
      </div>
    </div>
              

@endsection