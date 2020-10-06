<div id="formModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
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
                            <label class="control-label">Contact : </label>
                            <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter Contact Number" />
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Telephone : </label>
                            <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Enter Telephone Number" />
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">E-mail : </label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter E-mail Adress" />
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Address : </label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" />
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
