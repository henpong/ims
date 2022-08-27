

<!-- Delete One Transaction Detail -->
<div class="modal fade " id="newTransaction" tabindex="-1" role="dialog"  aria-labelledby="newTransLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="newTransLabel"><i class="fas fa-paper-plane text-blue"></i> New Transaction ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: #ff0000;">×</span>
        </button>
        </div>

        
            <div class="modal-body m-3">
            
                <p style="margin-bottom:0px">Do you want to perform another transaction ?</p>
                
            </div>

            <div class="modal-footer">
                <a href="{{ url('sales/dashboard') }}" class="btn btn-sm btn-outline-danger mt-2"  >
                    <i class="fas fa-times text-red"> </i> &nbsp;&nbsp;
                    No
                </a>
                <a href="{{ url('sales/creditors') }}" class="btn btn-sm btn-primary"  >
                    <i class="fas fa-paper-plane text-white"> </i> &nbsp;&nbsp;
                    Yes
                </a>
            </div>
    </div>
    </div>
</div>
<!-- End of Delete One Transaction Detail -->