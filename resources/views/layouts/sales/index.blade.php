


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>{{ $metaTitle ?? config('app.name', 'Nakwasoft') }}</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" sizes="32x32" href="{{url('backend/img/chiboy_logo.png')}}">
      <link rel="stylesheet" href="{{url('backend/css/backend-plugin.min.css')}}">
      <link rel="stylesheet" href="{{url('backend/css/backende209.css?v=1.0.0')}}">
      <link rel="stylesheet" href="{{url('backend/login_css/custom.css')}}">
      <link rel="stylesheet" href="{{url('backend/vendor/fortawesome/fontawesome-free/css/all.min.css')}}">
	   <link rel="stylesheet" href="{{url('backend/login_css/font-awesome.min.css')}}"  type="text/css" />
      <link rel="stylesheet" href="{{url('backend/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">
      <link rel="stylesheet" href="{{url('backend/vendor/remixicon/fonts/remixicon.css')}}"> 
      <link rel="stylesheet" href="{{url('backend/css/toastr.min.css')}}">  
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
                                 <h2 class="mb-2">Log In</h2>
                                 <p>Login to stay connected.</p>
                                 <form action="{{ url('/sales/login/{id}') }}" method="post">@csrf
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="email" name="email" id="email" autocomplete="off">
                                             <label>Email Address</label>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="password" name="password" id="pass" autocomplete="off">
                                             <label>Password</label>
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" style="">Log In</button><br>
                                    <div class="col-lg-6">
                                        <a href="#" class="text-primary float-right">Forgot Password?</a>
                                    </div>
                                 </form>
                              </div>
                           </div>
                           <div class="col-lg-5 content-right">
                              <img src="{{asset('backEnd/img/logo.jpg')}}" class="img-fluid image-right chi-logo" alt="">
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
    <script src="{{asset('backend/js/backend-bundle.min.js')}}"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="{{asset('backend/js/table-treeview.js')}}"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="{{asset('backend/js/customizer.js')}}"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="{{asset('backend/js/chart-custom.js')}}"></script>
    
    <!-- app JavaScript -->
    <script src="{{asset('backend/js/app.js')}}"></script>
    <!-- Toastr Notification -->
    <script src="{{asset('backend/js/toastr.min.js')}}"></script>
  </body>



  <!-- Display Success Message -->
  @if(Session::has('success_message'))
      <script>
         toastr.success("{!!Session::get('success_message') !!}");
         var audio = new Audio('audio.mp3');
            audio.play();
      </script>
  @endif
  <!-- Display Error Message -->
  @if(Session::has('error_message'))
      <script>
         toastr.error("{!!Session::get('error_message') !!}");
         var audio = new Audio('audio.mp3');
            audio.play();
      </script>
  @endif
</html>