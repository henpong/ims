
  <!-- Modal Edit -->
  <div class="modal fade" id="approveLowstockRequest" role="dialog" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="approveLowstockRequestForm" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-body">

                      <div class="media align-items-top justify-content-between">                            
                          <h4 class="mb-3" id="approveLowstockRequestForm"> <i class="fas fa-pen text-blue"> </i> UPDATE REQUEST</h4>
                          <div class="btn-cancel p-0" data-dismiss="modal"><i class="fas fa-times text-red"></i></div>
                      </div>

                        <form name="lowstockRequestForm" id="lowstockRequestForm" action="{{url('/admin/lowstock_request_decision/request_id')}}" method="POST" enctype="multipart/form-data">@csrf 
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
                                    <option value="Approved"> Approved </option>
                                    <option value="Rejected"> Rejected </option>
                                    <option value="Pending"> Pending </option>
                                    
                                  </select> 
                                </div>
                                  <!--End Select Request -->
                                <input type="hidden" id="request_id" name="request_id">
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