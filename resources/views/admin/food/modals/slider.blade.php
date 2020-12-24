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
                            <label class="control-label"> Image Header : </label>
                            <input type="text" name="header" id="header" class="form-control" placeholder="Enter Image Header"  />
                            <span class="text-danger">Max 20 characters</span>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label"> Image Remarks : </label>
                            <input type="text" name="remarks" id="remarks" class="form-control" placeholder="Enter Image Remarks"  />
                            <span class="text-danger">Max 100 characters</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label"> Text Color : </label>
                            <input type="text" name="favcolor" id="favcolor" class="simple_color form-control"  value="#e51937"/>
                        </div>
                    
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label"> Image : </label>
                            <input type="file" name="image" id="image" class="form-control" onchange="document.getElementById('preview1').src = window.URL.createObjectURL(this.files[0])" />
                            <span class="text-danger">Picture Resolution (1520 * 670) px</span>
                        </div>
                        <div class="col-md-6">
                            <img id="preview1" alt="Image Not Selected" class="rounded mx-auto d-block" width="200" height="150" />
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
