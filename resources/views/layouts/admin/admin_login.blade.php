


<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>{{ $metaTitle ?? config('app.name', 'Nakwasoft') }}</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" sizes="32x32" href="{{asset('backend/img/logo.jpg')}}">
      <link rel="stylesheet" href="{{url('backEnd/css/backend-plugin.min.css')}}">
      <link rel="stylesheet" href="{{url('backEnd/css/backende209.css?v=1.0.0')}}">
      <link rel="stylesheet" href="{{url('backEnd/login_css/custom.css')}}">
      <link rel="stylesheet" href="{{url('backEnd/vendor/fortawesome/fontawesome-free/css/all.min.css')}}">
	   <link rel="stylesheet" href="{{url('backEnd/login_css/font-awesome.min.css')}}"  type="text/css" />
      <link rel="stylesheet" href="{{url('backEnd/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">
      <link rel="stylesheet" href="{{url('backEnd/vendor/remixicon/fonts/remixicon.css')}}">
      <link rel="stylesheet" href="{{url('backEnd/css/toastr.min.css')}}">   
</head>
  <body class=" ">
    <!-- loader Start -->
    <!-- <div id="loading">
          <div id="loading-center">
          </div>
    </div> -->
    <!-- loader END -->
    
      <div class="wrapper">
         <section class="login-content">
            <div class="container">
               <div class="row align-items-center justify-content-center height-self-center">
                  <div class="col-lg-8">
                     <div class="card auth-card">
                        <div class="card-body p-0">
                           <div class="d-flex align-items-center auth-content">
                              <div class="col-lg-7 align-self-center">

                                 <div class="p-3">
                                    <h2 class="mb-2">Admin Log In</h2>
                                    <p style="color:#ff0000">Login to stay connected.</p>
                                    <form action="{{url('/admin')}}" method="post">@csrf
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <div class="floating-label form-group">
                                                <input class="floating-input form-control" type="text" name="username" id="username" autocomplete="off">
                                                <label>Username</label>
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="floating-label form-group">
                                                <input class="floating-input form-control" type="password" name="password" id="pass" autocomplete="off">
                                                <label>Password</label>
                                             </div>
                                          </div>
                                       </div>
                                       <button type="submit" class="btn btn-primary btn-block">Log In</button>
                                       <br>
                                       <div class="col-lg-6">
                                          <a href="#" class="text-primary ">Forgot Password?</a>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <div class="col-lg-5 content-right">
                                 <img src="{{ asset('backend/img/logo.jpg') }}" class="img-fluid image-right chi-logo" alt="">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
    
    <!-- Backend Bundle JavaScript -->
    <script src="{{asset('backEnd/js/backend-bundle.min.js')}}"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="{{asset('backEnd/js/table-treeview.js')}}"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="{{asset('backEnd/js/customizer.js')}}"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="{{asset('backEnd/js/chart-custom.js')}}"></script>
    
    <!-- app JavaScript -->
    <script src="{{asset('backEnd/js/app.js')}}"></script>
    <!-- Toastr Notification -->
    <script src="{{asset('backEnd/js/toastr.min.js')}}"></script>
  </body>


  
  <!-- Display Success Message -->
  @if(Session::has('success_message'))
      <script>
         toastr.success("{!!Session::get('success_message') !!}");
      </script>
  @endif
  <!-- Display Error Message -->
  @if(Session::has('error_message'))
      <script>
         toastr.error("{!!Session::get('error_message') !!}");
      </script>
  @endif
</html>