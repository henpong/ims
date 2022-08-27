@extends('layouts.salesLayout.sales_design')
@section('content')
 
    
<form class="navbar-left navbar-form nav-search mr-md-3">
    <div class="input-group">
        <div class="input-group-prepend">
            <button type="submit" class="btn btn-search pr-1">
                <i class="fa fa-search search-icon"></i>
            </button>
        </div>
        <input type="text" placeholder="Search ..." class="form-control">
    </div>
</form>

@endsection