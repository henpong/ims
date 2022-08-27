

<!DOCTYPE html>
<html> 
<head>
	<title>{{ $metaTitle ?? config('app.name', 'Nakwasoft') }}</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{ url('frontEnd/css/login.css') }}" type="text/css">
	  <link rel="stylesheet" href="{{ url('frontEnd/bootcss/font-awesome/css/font-awesome.css') }}" type="text/css" >
	  <link rel="icon" href="{{ url('frontEnd/images/logo.jpg') }}">
	  <!-- <link rel="stylesheet" href="{{ url('frontEnd/bootcss/dist/css/skins/_all-skins.min.css') }}"> -->
	  <style>
	  	.fa{
		    position: absolute;
		    left: 800px;
		    top: 290px;
		    color: #031a4d;
		    cursor: pointer;
		}
	</style>
	</head>
	<body class="hold-transition login-page">
		<div class="sales-login container">
    	<img src="{{ url('frontEnd/images/logo.jpg') }}">

            
			<form method="POST" action="{{ url('/sales/login/{id}') }}" >@csrf
			
			<div class="form-input">
				<label>Email </label>
				<input type="email" name="email" id="email" placeholder="Enter Your Email Address" autofocus="username" autocomplete="off">
			</div>


			<div class="password">
				<label>Password</label>
				<!-- <i class="fa fa-eye-slash" id="eye"></i> -->
				<input type="password" name="password" id="pass" placeholder="Enter Your Password" autocomplete="off">
			</div>


			<!-- <div class="branch">
				<label>Branch</label>
				<select name="branchid" id="branchid">
					<option value="">*** Select Branch ***</option>
					
				</select>
			</div> -->

			<br>
				<button type="reset" name="reset" class="btn btn-default" style="margin-right:10px;margin-left: 10px;"><i class="glyphicon glyphicon-remove"></i> Clear</button>
				
				<button type="submit" class="btn btn-success" id="submitDetailsBtn" data-loading-text="Loading..." > <i class="glyphicon glyphicon-ok "></i> Log In </button>
			<p style="font-size: 12px">
				Are You An Administrator ? <a href="{{ url('/admin') }}" class="admin_log" style="font-size: 12px"> Admin Log In </a>
			</p>
		</form>
	</div>

<script>
	var passView = document.getElementById("pass");
	var eyeView = document.getElementById("eye");
	eyeView.addEventListener('click',showPassword);

	function showPassword(){
		//Set Condition
		if(passView.getAttribute("type") == "password"){
			//Show Password
			eyeView.removeAttribute("class");
			eyeView.setAttribute("class","fa fa-eye");
			passView.removeAttribute("type");
			passView.setAttribute("type","text");

		}else{
			//Hide Password
			passView.removeAttribute("type");
			passView.setAttribute("type","password");
			eyeView.removeAttribute("class");
			eyeView.setAttribute("class","fa fa-eye-slash");
		}

	}
</script>


<script>
	history.pushState(null, null, location.href);
	window.onpopstate = function(){
		history.go(1);
	};
</script>
<footer>
	<div id="footer">
		<p> &copy;  Copyright || Nakwasoft Technologies, <?php echo date("Y"); ?> <strong><a href="#" style="color: #00ffff;text-decoration:none"> IMS - Chiboy Co. Ltd.</a></strong> All rights reserved.</p>
	</div>
</footer>
</body>
</html>





