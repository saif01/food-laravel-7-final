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


                    <div class="form-group ">
                        
                        <label class="control-label">Title : </label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Product title" />
                       
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req-star">Category:</label>
                                <select class="form-control" name="cat_id" id="Category" required="required">
                                        <option value="" disabled selected>Select Category Name</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Price : </label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Enter Product Price" />
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="req-star">Subcategory:</label>
                                <select class="form-control form-control-sm" name="sub_id" id="SubCategory" required="required">
                                </select>
                            </div>
                        </div> --}}

                    </div>

                    <div class="form-group">
                        <label class="control-label">Product Details : </label>
                        <textarea name="details" id="details" class="form-control"></textarea>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="control-label"> Image : </label>
                            <input type="file" name="image" id="image" class="form-control" onchange="document.getElementById('preview1').src = window.URL.createObjectURL(this.files[0])" />
                            <span class="text-danger">Picture Resolution (391 * 213) px</span>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label"> Image 2 : </label>
                            <input type="file" name="image2" id="image2" class="form-control" onchange="document.getElementById('preview2').src = window.URL.createObjectURL(this.files[0])" />
                            <span class="text-danger">Picture Resolution (391 * 213) px</span>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label"> Image 3 : </label>
                            <input type="file" name="image3" id="image3" class="form-control" onchange="document.getElementById('preview3').src = window.URL.createObjectURL(this.files[0])" />
                            <span class="text-danger">Picture Resolution (391 * 213) px</span>
                        </div>



                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <img id="preview1" alt="Image Not Selected" class="rounded mx-auto d-block" width="200" height="150" />
                        </div>

                        <div class="col-md-4">
                            <img id="preview2" alt="Image Not Selected" class="rounded mx-auto d-block" width="200" height="150" />
                        </div>
                        <div class="col-md-4">
                            <img id="preview3" alt="Image Not Selected" class="rounded mx-auto d-block" width="200" height="150" />
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
