<div id="formModal_2" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Role assign to user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <span id="form_result_2"></span>

                <form method="post" id="sample_form_2">
                    @csrf

                    <input type="hidden" name="current_user_id" id="current_user_id">

                    <label class="control-label badge text-success">User Access</label>
                    <div class="form-group row" id="roleCheckBoxData">

                    </div>

                    <div class="form-group text-center">
                        <input type="submit" id="action_button_2" class="btn btn-success btn-block" value="Add Roles" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
