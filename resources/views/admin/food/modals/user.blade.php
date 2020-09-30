<div id="formModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
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

                    {{-- <div class="form-group">
                        <label class="control-label">Login ID : </label>
                        <input type="text" name="login" id="login_id" class="form-control" placeholder="Enter Login ID" />
                    </div> --}}

                    <div class="form-group">
                        <label class="control-label"> Email : </label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email Address" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">Login Password : </label>
                        <input type="text" name="password" class="form-control" placeholder="Enter Login password" />
                    </div>


                    <div class="form-group">
                        <label class="control-label">Name : </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter User Name" />
                    </div>




                    <div class="form-group">
                        <label class="control-label"> Contact : </label>
                        <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter Contact Number" />
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label"> Image : </label>
                            <input type="file" name="image" id="image" class="form-control" onchange="document.getElementById('preview1').src = window.URL.createObjectURL(this.files[0])" />
                        </div>
                        <div class="col-md-6">
                            <img id="preview1" alt="Image Not Selected" class="rounded mx-auto d-block" width="100" height="100" />
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
