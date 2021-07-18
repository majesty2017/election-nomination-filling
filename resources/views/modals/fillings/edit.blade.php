<!-- Modal -->
<div
        class="modal fade text-left"
        id="edit-filling-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel1"
        aria-hidden="true"
>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Edit Filling</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-filling-form" action="{{ route('filling-update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="e_id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ee_student_id">Applicant</label>
                                <select class="form-control select2" name="applicant_id" id="ee_student_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ee_programme_id">Programme</label>
                                <select class="form-control select2" name="programme_id" id="ee_programme_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ee_department_id">Department</label>
                                <select class="form-control select2" name="department_id" id="ee_department_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ee_portfolio_id">Portfolio</label>
                                <select class="form-control select2" name="portfolio_id" id="ee_portfolio_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_dob">Date of Birth</label>
                                <input type="text" class="form-control datepicker" name="dob" id="e_dob" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="f_image">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="f_image" onclick="load_image('f_image', 'f_image_loader')" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div class="mt-2" id="ee_image_loader"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_father_name">Father name</label>
                                <input type="text" class="form-control" name="father_name" id="e_father_name" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_mother_name">Mother name</label>
                                <input type="text" class="form-control" name="mother_name" id="e_mother_name" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_address">Address</label>
                                <textarea class="form-control" name="address" id="e_address" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_hall_name">Hall name</label>
                                <input type="text" class="form-control" name="hall_name" id="e_hall_name" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_denomination">Denomination</label>
                                <input type="text" class="form-control" name="denomination" id="e_denomination" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_position_occupied">Position occupied</label>
                                <input type="text" class="form-control" name="position_occupied" id="e_position_occupied" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="e_working_experience">working experience</label>
                                <textarea class="form-control" name="working_experience" id="e_working_experience" rows="3"></textarea>
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