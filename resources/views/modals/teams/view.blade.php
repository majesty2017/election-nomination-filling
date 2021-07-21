<!-- Modal -->
<div
        class="modal fade text-left"
        id="view-team-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel1"
        aria-hidden="true"
>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Team details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @csrf

                    <div class="row mb-50">
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                <div class="custom-file" id="vv_image"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <div id="v_name"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Designation</label>
                                <div id="v_designation"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Twitter Url</label>
                                <div id="v_twitter_url"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Facebook Url</label>
                                <div id="v_facebook_url"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Instagram Url</label>
                                <div id="v_instagram_url"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">LinkedIn Url</label>
                                <div id="v_linkedin_url"></div>
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