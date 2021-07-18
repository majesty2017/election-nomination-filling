<!-- Modal -->
<div
        class="modal fade text-left"
        id="edit-team-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel1"
        aria-hidden="true"
>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Edit Team</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-team-form" action="{{ route('team-update') }}" method="post" enctype="multipart/form-data">
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
                                <label for="e_designation">Designation</label>
                                <input type="text" class="form-control" name="designation" id="e_designation" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="eimage">Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="eimage" onclick="load_image('eimage', 'eimage_loader')" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div class="mt-2" id="eimage_loader"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_twitter_url">Twitter Url</label>
                                <input type="text" class="form-control" name="twitter_url" id="e_twitter_url" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_facebook_url">Facebook Url</label>
                                <input type="text" class="form-control" name="facebook_url" id="e_facebook_url" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_instagram_url">Instagram Url</label>
                                <input type="text" class="form-control" name="instagram_url" id="e_instagram_url" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_linkin_url">LinkIn Url</label>
                                <input type="text" class="form-control" name="linkin_url" id="e_linkin_url" placeholder="">
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