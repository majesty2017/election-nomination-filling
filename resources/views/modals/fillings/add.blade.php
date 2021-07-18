<!-- Modal -->
<div
        class="modal fade text-left"
        id="add-filling-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel1"
        aria-hidden="true"
>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Add New Filling Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-filling-form" action="{{ route('filling-create') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="applicant_id">Applicant</label>
                                <select class="form-control select2" name="applicant_id" id="applicant_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="programme_id">Programme</label>
                                <select class="form-control select2" name="programme_id" id="programme_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select class="form-control select2" name="department_id" id="department_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="portfolio">Portfolio</label>
                                <select class="form-control select2" name="portfolio_id" id="portfolio">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="text" class="form-control datepicker" name="dob" id="dob" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image" onclick="load_image('image', 'image_loader')" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div class="mt-2" id="image_loader"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="father_name">Father name</label>
                                <input type="text" class="form-control" name="father_name" id="father_name" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mother_name">Mother name</label>
                                <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hall_name">Hall name</label>
                                <input type="text" class="form-control" name="hall_name" id="hall_name" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="denomination">Denomination</label>
                                <input type="text" class="form-control" name="denomination" id="denomination" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position_occupied">Position occupied</label>
                                <input type="text" class="form-control" name="position_occupied" id="position_occupied" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="working_experience">Working experience</label>
                                <textarea class="form-control" name="working_experience" id="working_experience" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Basic trigger modal end -->