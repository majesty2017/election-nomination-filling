<!-- Modal -->
<div
        class="modal fade text-left"
        id="add-team-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel1"
        aria-hidden="true"
>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Add New Team</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-team-form" action="{{ route('team-create') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" name="designation" id="designation" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image" onclick="load_image('image', 'image_loader')" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div class="mt-2" id="image_loader"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="twitter_url">Twitter Url</label>
                                <input type="text" class="form-control" name="twitter_url" id="twitter_url" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="facebook_url">Facebook Url</label>
                                <input type="text" class="form-control" name="facebook_url" id="facebook_url" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="instagram_url">Instagram Url</label>
                                <input type="text" class="form-control" name="instagram_url" id="instagram_url" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="linkedin_url">LinkedIn Url</label>
                                <input type="text" class="form-control" name="linkedin_url" id="linkedin_url" placeholder="">
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