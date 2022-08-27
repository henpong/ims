
<!-- Delete One Transaction Detail -->
<div class="modal fade" id="deleteCreditTrans{{ $trans->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteTrans" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="deleteCreditTrans"><i class="fas fa-trash text-red"></i> Delete Record ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: #ff0000;">×</span>
        </button>
        </div>

        <form action="{{ url('admin/delete_credit_transaction/'.$insertid) }}" method="post">@csrf 
            <div class="modal-body m-3">
            
                <p style="margin-bottom:0px">Are you sure you want to delete <strong>{{ $trans->mainwarehouse->main_product_name }} </strong>?</p>
                <small style="color: #ff0000;"> (Note that this record would be deleted.) </small>

                <input type="hidden" class="form-control" name="insertid" value="{{ $insertid }}" required>
                <input type="hidden" class="form-control" id="id" name="id" value="{{ $trans->id }}" required> 
                <input type="hidden" class="form-control" id="productid" name="productid" value="{{ $trans->mainwarehouse->id }}" required>
            </div>

            <div class="modal-footer">
            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                <i class="fas fa-times text-white fa-spin"> </i> &nbsp;&nbsp;
                No, Go Back
            </button>
            <button class="btn btn-sm btn-primary" type="submit" >
                <i class="fas fa-paper-plane text-white"> </i> &nbsp;&nbsp;
                Yes, Delete
            </button>
            </div>
        </form>
    </div>
    </div>
</div>
<!-- Delete One Transaction Detail -->