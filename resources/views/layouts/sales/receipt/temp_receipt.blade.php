@extends('layouts.salesLayout.sales_design')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="temptrans" style="text-align:center;margin-top:250px">
        
            <p style="color:#29A744;font-size:40px;margin-bottom:50px">
                <strong >Congratulations!</strong> Transaction recorded successfully. 
            </p>


            <a class="btn btn-danger" href="{{ url('/sales/dashboard') }}">
              <i class="fas fa-times text-white"> </i> &nbsp;&nbsp;
                Go Home
            </a>
          
            <a  class="btn btn-primary" href="{{ url('sales/temp_transaction') }}">
              <i class="fas fa-list-alt"></i> 
               Add Temp Trans
            </a>

      </div>
    </div>
  </div>
</div>
        

@endsection
  

