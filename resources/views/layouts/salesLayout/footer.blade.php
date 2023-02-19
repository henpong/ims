


       </div>
        <!-- Page end  -->
        </div>
     </div>
    </div>
    <!-- Wrapper End-->





    <!-- Temp Transaction-->
    <div class="modal fade show" id="successtempTrans" tabindex="-1" role="dialog" aria-labelledby="successtempTrans" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="successtempTransModalLabel"> <i class="fas fa-book text-blue"> </i> Temporal Customers Transaction </h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:#ff0000;">&times;</span>
					</button>
				</div>
			<div class="modal-body">
				<p style="color:#ffff00">
				  	<strong >Congratulations!</strong> Transaction recorded successfully. 
				</p>
			</div>
				<div class="modal-footer">
					<a class="btn btn-sm btn-danger" href="{{ url('/sales/dashboard') }}">
						<i class="fas fa-times text-white"> </i> &nbsp;&nbsp;
							Go Home
					</a>
					<a class="btn btn-sm btn-primary" href="{{ url('/sales/temp_transaction') }}">
						<i class="fas fa-paper-plane text-green fa-spin"> </i> &nbsp;&nbsp;
						Add Temp Trans
					</a>
					<!-- <a class="btn btn-primary" href="{{ url('/sales/dashboard') }}"> 
						<i class="fas fa-paper-plane text-blue fa-sm fa-fw mr-2 text-gray-400"> </i> Ok
					</a> -->
				</div>
			</div>
		</div>
    </div>
	<!-- Temp Transaction -->




    <!-- View Report-->
    <div class="modal fade show" id="viewReport" tabindex="-1" role="dialog" aria-labelledby="viewReport" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="viewReportModalLabel"> <i class="fas fa-book text-blue"> </i> View Reports </h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:#ff0000;">&times;</span>
					</button>
				</div>
			<div class="modal-body">
				<p>
				  Sorry, Your profile does not allow you to perform this action. <br> Please contact your boss.
				</p>
			</div>
				<div class="modal-footer">
					<!-- <button class="btn btn-danger" type="button" data-dismiss="modal"> <i class="fas fa-times fa-sm fa-fw mr-2 text-gray-400"> </i> Cancel</button> -->
					<a class="btn btn-primary" href="{{ url('/sales/dashboard') }}"> Ok</a>
				</div>
			</div>
		</div>
    </div>
	<!-- View Report -->




    <!-- Logout Modal-->
    <div class="modal fade show" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:#ff0000;">&times;</span>
					</button>
				</div>
				<div class="modal-body">Are you sure you want to log-out ?</div>
				<div class="modal-footer">
					<button class="btn btn-danger" type="button" data-dismiss="modal"> <i class="fas fa-times fa-sm fa-fw mr-2 text-gray-400"> </i> Cancel</button>
					<a class="btn btn-primary" href="{{ url('/sales/logout') }}"> <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-400"> </i> Logout</a>
				</div>
			</div>
		</div>
    </div>



    


    <!-- Update First Time Login Password Modal-->
    <div class="modal fade" id="updPsdFirstTimeModal" tabindex="-1" role="dialog" aria-labelledby="updPsdFirstTimeModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updPsdFirstTimeModalLabel"> <i class="fas fa-user-lock"> </i> Update Password</h5>
                    <!-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#ff0000;">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">

                    <p style="color:#ff0000">
                        Hello friend, I can see this is your first time of logging in... <br>Please enter your new password to start using the system.
                    </p>
                    <form role="form" method="POST" action="{{('/sales/update_first_time_password')}}" name="updateFirstTimePasswordForm" id="updateFirstTimePassword">@csrf
                                                
                            <div class="form-group">
                                <label for="newFirstTimePass">New Password</label>
                                <input type="password" class="form-control" id="newFirstTimePass" name="newFirstTimePass" placeholder="Enter New Password">
                            </div>

                            <div class="form-group">
                                <label for="confirmFirstTimePass">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmFirstTimePass" name="confirmFirstTimePass" placeholder="Confirm New Password">
                            </div> 

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <!-- Update Password Modal-->
    <div class="modal fade" id="updPasswordModal" tabindex="-1" role="dialog" aria-labelledby="updPasswordModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updPasswordModalLabel"> <i class="fas fa-user-lock"> </i> Update Password</h5>
                <!-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#ff0000;">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">Great ! your password has been updated successfully. <br>Please log out and log in again.</div>
            <div class="modal-footer">
                <!-- <button class="btn btn-danger" type="button" data-dismiss="modal"> <i class="fas fa-times fa-sm fa-fw mr-2 text-gray-40"> </i> No </button> -->
                <a class="btn btn-primary" href="{{ url('/sales/logout') }}"> <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-40"> </i> Logout</a>
            </div>
            </div>
        </div>
    </div>




    <footer class="iq-footer">
          <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="#">All right reserved</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="mr-1"><script data-cfasync="false" src="../../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear())</script>&copy; &nbsp;<a href="#">Nakwasoft Technologies</a></span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <script src="{{asset('backEnd/js/backend-bundle.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('backEnd/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backEnd/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
	<!-- JQUERY VALIDATION -->
	<script src="{{asset('backEnd/js/validation.min.js')}}"></script>
    <!--Custom Admin JS -->
    <script src="{{asset('backEnd/js/admin_script.js')}}"></script>
    <!-- Select 2 -->
    <script src="{{asset('backEnd/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('backEnd/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('backEnd/plugins/bootstrap-datepicker/js/daterangepicker.min.js')}}"></script>
    <!-- Sweet Alert2 -->
    <script src="{{asset('backEnd/js/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <!-- Table Treeview JavaScript -->
    <script src="{{asset('backEnd/js/table-treeview.js')}}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{asset('backEnd/js/customizer.js')}}"></script>
    <!-- Chart Custom JavaScript -->
    <script async src="{{asset('backEnd/js/chart-custom.js')}}"></script>
    <!-- app JavaScript -->
    <script src="{{asset('backEnd/js/app.js')}}"></script>
	<!-- Atlantis JS -->
	<script src="{{asset('frontEnd/js/atlantis.min.js')}}"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{asset('frontEnd/js/setting-demo.js')}}"></script>
	<script src="{{asset('frontEnd/js/demo.js')}}"></script>
	<!--Custom  JS -->
	<!-- <script src="{{asset('frontEnd/js/front_script.js')}}"></script> -->
	<!-- Select 2 -->
	<script src="{{asset('frontEnd/plugins/select2/select2.min.js')}}"></script>
	<!-- Calculate Sales -->
	<script src="{{asset('frontEnd/js/autosum.js')}}"></script>
	<!-- Toastr Notification -->
    <script src="{{asset('backEnd/js/toastr.min.js')}}"></script>



	<script>
		$('#lineChart').sparkline([102,109,120,99,110,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#177dff',
			fillColor: 'rgba(23, 125, 255, 0.14)'
		});

		$('#lineChart2').sparkline([99,125,122,105,110,124,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#f3545d',
			fillColor: 'rgba(243, 84, 93, .14)'
		});

		$('#lineChart3').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>


	<script>
        $(function() {
            $('input[name="monthTransactionDate"]').daterangepicker({
                opens: 'center'
            });
        });
    </script>

	<!-- Date picker -->
	<script>
		$('#transactionDate').datepicker({
			autoclose: true
		});
	</script>


	<script>
		$( ".selectpicker" ).select2({
			theme: "bootstrap",
			width: "100%"
		});
	</script>


	<script>
		$("#customers").dataTables();
		$("#creditors").dataTables();
		$("#stocks").dataTables();
		$("#lowstocks").dataTables();
		$("#lowstockrequested").dataTables();
		$("#returnedgoods").dataTables();
		$("#spoiltgoods").dataTables();
		$("#expense").dataTables();
		$("#expensesdestail").dataTables();
		$("#goodshop").dataTables();
		$("#gaspds").dataTables();
		$("#pricelist").dataTables();
		$("#creditTable").dataTables();
		$("#creditpaiddestail").dataTables();
		$("#cashTable").dataTables();
		$("#paymentTable").dataTables();
	</script>


	<script>

		$(document).ready(function(){

			
			$(document).on('change','#custid', function(){
				// console.log("It changed"); 

				var customerId = $(this).val();
				//  console.log(customerId); 
				
				var op="";

				var div = $(this).parent().parent().parent();
				// div.css('background-color','green');

				
					$.ajax({
						type:'get',
						url:'{!!URL::to("sales/getcustomername")!!}',
						data:{'id':customerId},
						success:function(data){
							
								// console.log('success');
								// console.log(data); 
								// console.log(data.length);

								op+='<option value=""> ';							
									op+=" *** Select Customer's Name *** ";
								op+='</option>';
							
								for(var i=0;i<data.length;i++){
									op+='<option value="' + data[i].id + '">' + data[i].fullname + '</option>';
											
								}

								div.find('#custname').html("");
								div.find('#custname').append(op);  

						},
						error:function(){
							
						}
					});
			});

		});
	</script>



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

  



	@if(Session::has('first_log'))        
        <script>
            toastr.success("{!!Session::get('first_log') !!}");

            $(function() {
                $('#updPsdFirstTimeModal').modal('show');
            });
        </script>
    @endif


    @if(Session::has('upd_pass'))        
        <script>
            toastr.success("{!!Session::get('upd_pass') !!}");

            $(function() {
                $('#updPasswordModal').modal('show');
            });
        </script>
    @endif


  </body>
</html>