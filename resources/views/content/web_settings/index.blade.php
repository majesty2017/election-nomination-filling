@extends('layouts/contentLayoutMaster')

@section('title', 'Web Settings')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel='stylesheet' href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <!-- account setting page -->
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column nav-left">
                    <!-- general -->
                    <li class="nav-item">
                        <a
                                class="nav-link active"
                                id="account-pill-general"
                                data-toggle="pill"
                                href="#account-vertical-general"
                                aria-expanded="true"
                        >
                            <i data-feather="user" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">General</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!--/ left menu section -->

            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- general tab -->
                            <div
                                    role="tabpanel"
                                    class="tab-pane active"
                                    id="account-vertical-general"
                                    aria-labelledby="account-pill-general"
                                    aria-expanded="true"
                            >
                                <!-- form -->
                                <form id="web-setting-form" class="validate-form mt-2" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" id="id">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="mb-2" id="fimage_loader"></div>
                                            <div class="form-group">
                                                <label for="ffavicon">Favicon <span class="text-danger">*</span></label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="favicon" id="ffavicon" onclick="load_image('ffavicon', 'fimage_loader')" />
                                                    <label class="custom-file-label" for="ffavicon">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="mb-2" id="limage_loader"></div>
                                            <div class="form-group">
                                                <label for="llogo">Logo <span class="text-danger">*</span></label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo" id="llogo" onclick="load_image('llogo','limage_loader')" />
                                                    <label class="custom-file-label" for="llogo">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="copyright">Copyright <span class="text-danger">*</span></label>
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        id="copyright"
                                                        name="copyright"
                                                        placeholder="COPYRIGHT &copy; 2021 HTU SRC Election Filling, All rights Reserved"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="website">Website</label>
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        id="website"
                                                        name="website"
                                                        placeholder="www.yourwebsite.com"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="system_name">Company <span class="text-danger">*</span></label>
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        id="system_name"
                                                        name="system_name"
                                                        placeholder="HTU Filling System"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="short_name">Company Short Name / Prefix <span class="text-danger">*</span></label>
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        id="short_name"
                                                        name="short_name"
                                                        placeholder="Short Name / Prefix"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                            <!--/ general tab -->
                        </div>
                    </div>
                </div>
            </div>
            <!--/ right content section -->
        </div>
    </section>
    <!-- / account setting page -->
@endsection

@section('vendor-script')
    <!-- vendor files -->
    {{-- select2 min js --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    {{--  jQuery Validation JS --}}
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/page-account-settings.js')) }}"></script>
    <script>
        $(document).ready(function () {
            let _token = $('input[name=_token]').val()
            $('#web-setting-form').submit(function (e) {
                e.preventDefault()
                $.ajax({
                    url: '{{ route('web_setting-create') }}',
                    type: 'post',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (res) {
                        if (res.status === 'fail') {
                            let msg
                            $.each(res.error, function (a, b) {
                                msg = b
                                message('error', msg)
                            })
                        } else {
                            setTimeout(() => location.reload(), 100)
                            message('success', res.message)
                        }
                    }
                })
            })
        })
    </script>
@endsection
