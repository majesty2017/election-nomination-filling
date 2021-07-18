<!-- Modal -->
<div
        class="modal fade text-left"
        id="view-filling-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel1"
        aria-hidden="true"
>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Filling details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                <span class="mt-2" id="v_image_loader"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Applicant: </label>
                                <span id="v_applicant_id"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Programme: </label>
                                <span id="v_programme_id"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Department: </label>
                                <span id="v_department_id"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Portfolio: </label>
                                <span id="v_portfolio"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date of Birth: </label>
                                <span id="v_dob"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Father name: </label>
                                <span id="v_father_name"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Mother name: </label>
                                <span id="v_mother_name"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Address: </label>
                                <span id="v_address"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Hall name: </label>
                                <span id="v_hall_name"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Denomination: </label>
                                <span id="v_denomination"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Position occupied: </label>
                                <span id="v_position_occupied"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eworking_experience">Working experience: </label>
                                <span id="v_working_experience"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Basic trigger modal end -->