


       </div>
        <!-- Page end  -->
        </div>
     </div>
    </div>
    <!-- Wrapper End-->





    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:#ff0000;">&times;</span>
            </button>
        </div>
        <div class="modal-body">Are you sure you want to log-out ?</div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal"> <i class="fas fa-times fa-sm fa-fw mr-2 text-gray-400"> </i> Cancel</button>
            <a class="btn btn-primary" href="{{ url('/admin/logOut') }}"> <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-400"> </i> Logout</a>
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
    <!-- Calculate Sales -->
	<script src="{{asset('backEnd/js/autosum.js')}}"></script>
    
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

  </body>

</html>