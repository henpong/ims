


       </div>
        <!-- Page end  -->
        </div>
     </div>
    </div>
    <!-- Wrapper End-->





    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)" data-backdrop="static">
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
                <button class="btn btn-danger" type="button" data-dismiss="modal"> <i class="fas fa-times fa-sm fa-fw mr-2 text-gray-40"> </i> No </button>
                <a class="btn btn-primary" href="{{ url('/admin/logOut') }}"> <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-40"> </i> Logout</a>
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
                    <form role="form" method="POST" action="{{('/admin/update_first_time_password')}}" name="updateFirstTimePasswordForm" id="updateFirstTimePassword">@csrf
                                                
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
                <a class="btn btn-primary" href="{{ url('/admin/logOut') }}"> <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-40"> </i> Logout</a>
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
    <!-- JS Validation -->
    <script src="{{asset('backEnd/js/validation.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('backEnd/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backEnd/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
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
    <script src="{{asset('backEnd/js/toastr.min.js')}}"></script>

    <!-- Date Picker -->
    <script>
		// INITIALIZE DATEPICKER PLUGIN
		$('#transactionDate').datepicker();
	</script>
    <!-- Date Range Picker -->

    <script>
        $(function() {
            $('#monthTransactionDate').daterangepicker({
                opens: 'center'
            });
        });
    </script>
    
<script>
  //DataTables
  $(function(){
    $("#branches").dataTables();
    $("#expenses").dataTables();
    $("#sections").dataTables();
    $("#categories").dataTables();
    $("#users").dataTables();
    $("#customers").dataTables();
    $("#suppliers").dataTables();
    $("#bank").dataTables();
    $("#mainwarehouse").dataTables();
    $("#mainwarehouseTrans").dataTables();
    $("#mainwarehouseTransTaken").dataTables();
    $("#products").dataTables();
    $("#stockrequest").dataTables();
    $("#temporalcredit").dataTables();
    $("#creditrequest").dataTables();
    $("#lowstock").dataTables();
  });

</script>

<script>
    $( ".selectpicker" ).select2({
        theme: "bootstrap"
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