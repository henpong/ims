  
 
    <!-- Add Creditor -->
    <div class="modal fade" id="addCreditors" tabindex="-1" role="dialog" aria-labelledby="addCreditors" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCreditor"><i class="fas fa-pen text-blue"></i> APPLY FOR NEW CREDIT</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #ff0000;">×</span>
                    </button>
                </div>

                <form action="{{ url('sales/addcreditor/' ) }}" method="post">@csrf

                    <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                        <div class="col-12">
                            <label class="" for="fname">Full Name</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Creditor's Full Name" autocomplete="off"/>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="" for="address">Address</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <textarea class="form-control" id="address" name="address" cols="10" rows="3" placeholder="Enter Address">

                                </textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="" for="phone">Phone Number</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="phone" name="phone" max="10" autocomplete="off" placeholder="Enter Phone Number" />
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="" for="company">Company Name</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="company" name="company" autocomplete="off" placeholder="Enter Company Name" />
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="" for="yrsbiz">Years In Business</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="number" class="form-control" id="yrsbiz" name="yrsbiz" autocomplete="off" placeholder="Enter Years In Business" />
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="" for="bincome">Business Income</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="bincome" name="bincome" autocomplete="off" placeholder="GHC 0.00" />
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="" for="spouse">Spouse Name</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="spouse" name="spouse" autocomplete="off" placeholder="Enter Spouse Name" />
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="" for="sphone">Spouse Phone Number</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="sphone" name="sphone" autocomplete="off" placeholder="Enter Spouse Phone Number" />
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="" for="gname">Name of Guarantor</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="gname" name="gname" autocomplete="off" placeholder="Enter Guarantor's Name" />
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="" for="gphone">Guarantor's Phone Number</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="gphone" name="gphone" autocomplete="off" placeholder="Enter Guarantor's Phone Number" />
                            </div>
                        </div>

                        <!-- <div class="col-12">
                            <label class="" for="totalcredit">Total Amount of Credit (GHC)</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="totalcredit" name="totalcredit" autocomplete="off" placeholder="GHC 0.00" />
                            </div>
                        </div> -->
                        
                </div>

                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                            <i class="fas fa-times text-white fa-spin"> </i> &nbsp;&nbsp;
                            Cancel
                        </button>
                        <button class="btn btn-sm btn-primary" type="submit" >
                            <i class="fas fa-paper-plane text-white"> </i> &nbsp;&nbsp;
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Add Creditor -->