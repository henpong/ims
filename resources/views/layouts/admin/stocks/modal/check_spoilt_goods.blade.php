
  <!-- Modal Edit -->
  <div class="modal fade" id="checkSpoiltGoodsRequest{{ $goods->id }}" role="dialog" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="checkSpoiltGoodsRequestForm" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-body">

                      <div class="media align-items-top justify-content-between">                            
                          <h6 class="mb-3" id="checkSpoiltGoodsRequestForm"> <i class="fas fa-pen text-blue"> </i> UPDATE REQUEST</h6>
                          <div class="btn-cancel p-0" data-dismiss="modal"><i class="fas fa-times text-red"></i></div>
                      </div>

                        <form name="spoiltGoodsRequestForm" id="spoiltGoodsRequestForm" action="{{ url('/admin/check_spoilt_goods_decision/'.$goods->id) }}" method="POST" enctype="multipart/form-data">@csrf 
                            <!-- UPDATE LOW STOCK REQUEST -->

                          <div class="row">
                                <center>
                                  <small style="color:#ff0000;padding-left:50px">Please note that the decision taken <strong>CANNOT</strong> be reverted! Thank you.</small>
                                </center><br><br>
                                  <!--Select Request-->
                                  <label for="request_status" class="col-md-4"  style="text-align:right">Take Decision</label>
                                
                                <div class="col-md-7">
                                  <select class="form-control " name="request_status" id="request_status" style="width: 100%;">

                                    <option value="">*** SELECT DECISION***</option>
                                    <option value="2"> Checked / Approved </option>
                                    <option value="3"> Rejected </option>
                                    <option value="1"> Not Checked </option>
                                    
                                  </select> 
                                </div>
                                  <!--End Select Request -->
                                <input type="hidden" id="request_id" name="request_id" value="{{ $goods->id }}">
                                <input type="hidden" id="product_id" name="product_id" value="{{ $goods->product_id }}">
                                <input type="hidden" id="branch_id" name="branch_id" value="{{ $goods->branch_id }}">
                            </div>
                            <!-- /.row -->
                        </div>

                          <div class="card-footer border-0">
                              <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                  <button class="btn btn-warning mr-3" data-dismiss="modal"><i class="fas fa-times"> </i> Cancel</button>
                                  <button type="submit" class="btn btn-outline-primary" > <i class="fas fa-paper-plane"> </i> Submit</button>
                              </div>
                          </div>
                      </form>
              </div>
          </div>
      </div>
  </div>