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

                    <div class="form-group">
                        <label class="control-label"> Youtube Video Embed Link : </label>
                        <input type="text" name="video_link" id="video_link" class="form-control" placeholder="Enter Name" />
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label"> Image : </label>
                            <input type="file" name="image" id="image" class="form-control" onchange="document.getElementById('preview1').src = window.URL.createObjectURL(this.files[0])" />
                            <span class="text-danger">Picture Resolution (895 * 350) px</span>
                        </div>
                        <div class="col-md-6">
                            <img id="preview1" alt="Image Not Selected" class="rounded mx-auto d-block" width="200" height="70" />
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label">About Details : </label>
                        <textarea name="details" id="details" class="form-control"></textarea>
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
