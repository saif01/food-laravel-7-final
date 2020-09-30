<div id="formModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <span id="form_result"></span>

                <form method="post" id="sample_form" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                            <div class="col-md-6">
                                <label class="control-label">Division : </label>
                                <select class="form-control" name="division" id="division" required>
                                   <option value="">Select One Division</option>
                                   <option value="Dhaka">Dhaka</option>
                                   <option value="Khulna">Khulna</option>
                                   <option value="Chittagong">Chittagong</option>
                                   <option value="Rajshahi">Rajshahi</option>
                                   <option value="Barisal">Barisal</option>
                                   <option value="Comilla">Comilla</option>
                                   <option value="Sylhet">Sylhet</option>
                                   <option value="Rangpur">Rangpur</option>
                               </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">District : </label>
                                <input type="text" name="district" id="district" class="form-control" placeholder="Enter district name" />
                            </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">Local Area : </label>
                            <input type="text" name="local_area" id="local_area" class="form-control" placeholder="Enter local area name" />
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Shop Name : </label>
                            <input type="text" name="shop_name" id="shop_name" class="form-control" placeholder="Enter shop name" />
                        </div>
                    </div>

                     <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">Latitude : </label>
                            <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Enter Shop Latitude " />
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Longitude : </label>
                            <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Enter Shop Longitude" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">Contact : </label>
                            <input type="number" name="contact" id="contact" class="form-control" placeholder="Enter contact number" />
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Address : </label>
                            <textarea name="address" id="address" class="form-control" placeholder="Enter Outlet adress"></textarea>
                        </div>

                    </div>


                    <br />
                    <div class="form-group text-center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-success btn-block" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
