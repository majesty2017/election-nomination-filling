<!-- Modal -->
<div
        class="modal fade text-left"
        id="edit-student-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel1"
        aria-hidden="true"
>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Edit Applicant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-student-form" action="{{ route('user-update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="e_id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_name">Name</label>
                                <input type="text" class="form-control" name="name" id="e_name" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_phone">Phone</label>
                                <input type="tel" class="form-control" name="phone" id="e_phone" maxlength="12" min="10" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_email">Email</label>
                                <input type="email" class="form-control" name="email" id="e_email" placeholder="">
                            </div>
                        </div>
                        <input type="hidden" name="is_admin" id="e_is_admin" value="0">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ee_image">Profile picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="ee_image" onclick="load_image('ee_image', 'ee_image_loader')" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div class="mt-2" id="ee_image_loader"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ee_password">Password</label>
                                <input type="password"
                                       class="form-control" name="password" autocomplete="false" id="ee_password" aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-warning">Keep password field empty if you won't change it.</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ee_password_confirmation">Re-Type Password</label>
                                <input type="password"
                                       class="form-control" name="password_confirmation" autocomplete="false" id="ee_password_confirmation" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Basic trigger modal end -->