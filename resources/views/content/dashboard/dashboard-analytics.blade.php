
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection

@section('content')
  <form method="post">
    @csrf
  </form>

  <!--Closable Alerts start -->
  @if(session()->has('success'))
  <section id="alerts-closable">
    <div class="row">
      <div class="col-md-6 offset-3">
        <div class="demo-spacing-6">
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <div class="alert-body">
              <strong>Success! {{ session()->get('success') }}</strong>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
  <!--Closable Alerts end -->
  <!-- Dashboard Analytics Start -->
  <section id="dashboard-analytics">
  @if(auth()->user()->is_admin === 1)
      <div class="row match-height">
      <!-- Greetings Card starts -->
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card card-congratulations">
          <div class="card-body text-center">
            <img
                    src="{{asset('images/elements/decore-left.png')}}"
                    class="congratulations-img-left"
                    alt="card-img-left"
            />
            <img
                    src="{{asset('images/elements/decore-right.png')}}"
                    class="congratulations-img-right"
                    alt="card-img-right"
            />
            <div class="avatar avatar-xl bg-primary shadow">
              <div class="avatar-content">
                <i data-feather="award" class="font-large-1"></i>
              </div>
            </div>
            <div class="text-center">
              <h1 class="mb-1 text-white"><span id="greetings"></span> {{ auth()->user()->name }},</h1>
              <p class="card-text m-auto w-75">
                Welcome to, <strong>Nomination Filling Management System</strong>. We hope this system help solve your problems.
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Greetings Card ends -->

      <!-- Subscribers Chart Card starts -->
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-header flex-column align-items-start pb-0">
            <div class="avatar bg-light-primary p-50 m-0">
              <div class="avatar-content">
                <i data-feather="file" class="font-medium-5"></i>
              </div>
            </div>
            <h2 class="font-weight-bolder mt-1" id="count_fillings">0</h2>
            <p class="card-text">Nomination Fillings</p>
          </div>
          <div id="gained-chart"></div>
        </div>
      </div>
      <!-- Subscribers Chart Card ends -->

      <!-- Orders Chart Card starts -->
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
          <div class="card-header flex-column align-items-start pb-0">
            <div class="avatar bg-light-warning p-50 m-0">
              <div class="avatar-content">
                <i data-feather="credit-card" class="font-medium-5"></i>
              </div>
            </div>
            <h2 class="font-weight-bolder mt-1" id="count_payments">0</h2>
            <p class="card-text">Payments</p>
          </div>
          <div id="order-chart"></div>
        </div>
      </div>
      <!-- Orders Chart Card ends -->
    </div>
    @elseif(auth()->user()->payment_status === 0)
      <!-- Payment Card -->
        <div class="col-md-4 col-md-6 col-6 offset-3">
        <div class="card card-payment">
          <div class="card-header">
            <h4 class="card-title">Make Payment</h4>
            <h4 class="card-title text-primary" id="amount_title"></h4>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" role="form" class="form">
              @csrf

              <div class="row">
                <div class="col-12">
                  <div class="form-group mb-2">
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}"> {{-- required --}}
                    <input type="hidden" name="currency" value="GHS">
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group mb-2">
                    <label for="portfolio_id">Portfolio</label>
                    <select class="form-control select2" id="portfolio_id">
                      <option value="">Select option</option>
                    </select>
                    <input type="hidden" name="metadata" id="new_portfolio_id">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group mb-2">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" id="amount" readonly placeholder="0" />
                    <input type="hidden" class="form-control" name="amount" id="new_amount" />
                  </div>
                </div>
            </div>
                <div class="col-6">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">
                    <i class="fa fa-plus-circle fa-lg"></i> Make Payment</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!--/ Payment Card -->
    @endif

    @if(auth()->user()->payment_status === 1 && auth()->user()->is_filled === 0)
      <!-- Info table about actions -->
        <div class="row">
          <div class="col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">HTU SRC | Nomination Filling Form</div>
              <div class="card-body">
                <h4 class="card-title">{{ auth()->user()->name }}</h4>
                <p class="card-text">
                  <img src="{{ asset('images/profile/user-uploads/'.auth()->user()->image) }}" width="100" height="100" style="border-radius: 50px" alt="">
                </p>
                <form id="add-filling-form" action="{{ route('filling.create') }}" method="post" enctype="multipart/form-data">
                  @csrf

                  <input type="hidden" name="id" id="id">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fprogramme_id">Programme: <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="programme_id" id="fprogramme_id">
                          <option value="">Select option</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="department_id">Department: <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="department_id" id="department_id">
                          <option value="">Select option</option>
                        </select>
                      </div>
                    </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="phone">Phone Number: <span class="text-danger">*</span></label>
                          <input type="tel" class="form-control" name="phone" id="phone" value="{{ auth()->user()->phone }}">
                        </div>
                      </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="dob">Date of Birth: <span class="text-danger">*</span></label>
                        <input type="date" class="form-control flatpickr-human-friendly input" name="dob" id="dob" placeholder="Octomer 23, 2001">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="eimage">Image: <span class="text-danger">*</span></label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="image" id="eimage" onclick="load_image('eimage', 'eimage_loader')" />
                          <label class="custom-file-label" for="customFile">Choose file: <span class="text-danger">*</span></label>
                        </div>
                        <div class="mt-2" id="eimage_loader"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="father_name">Father name: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="father_name" id="father_name" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mother_name">Mother name: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="address">Address: <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="hall_name">Hall name: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="hall_name" id="hall_name" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="denomination">Denomination: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="denomination" id="denomination" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="position_occupied">Position occupied: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="position_occupied" id="position_occupied" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="working_experience">Working experience: <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="working_experience" id="working_experience" rows="3"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="save-edit">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--/ Info table about actions -->
      @endif
    <div class="row match-height d-none">
      <!-- Avg Sessions Chart Card starts -->
      <div class="col-lg-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="row pb-50">
              <div class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                <div class="mb-1 mb-sm-0">
                  <h2 class="font-weight-bolder mb-25">2.7K</h2>
                  <p class="card-text font-weight-bold mb-2">Avg Sessions</p>
                  <div class="font-medium-2">
                    <span class="text-success mr-25">+5.2%</span>
                    <span>vs last 7 days</span>
                  </div>
                </div>
                <button type="button" class="btn btn-primary">View Details</button>
              </div>
              <div class="col-sm-6 col-12 d-flex justify-content-between flex-column text-right order-sm-2 order-1">
                <div class="dropdown chart-dropdown">
                  <button
                          class="btn btn-sm border-0 dropdown-toggle p-50"
                          type="button"
                          id="dropdownItem5"
                          data-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                  >
                    Last 7 Days
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem5">
                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                  </div>
                </div>
                <div id="avg-sessions-chart"></div>
              </div>
            </div>
            <hr />
            <div class="row avg-sessions pt-50">
              <div class="col-6 mb-2">
                <p class="mb-50">Goal: $100000</p>
                <div class="progress progress-bar-primary" style="height: 6px">
                  <div
                          class="progress-bar"
                          role="progressbar"
                          aria-valuenow="50"
                          aria-valuemin="50"
                          aria-valuemax="100"
                          style="width: 50%"
                  ></div>
                </div>
              </div>
              <div class="col-6 mb-2">
                <p class="mb-50">Users: 100K</p>
                <div class="progress progress-bar-warning" style="height: 6px">
                  <div
                          class="progress-bar"
                          role="progressbar"
                          aria-valuenow="60"
                          aria-valuemin="60"
                          aria-valuemax="100"
                          style="width: 60%"
                  ></div>
                </div>
              </div>
              <div class="col-6">
                <p class="mb-50">Retention: 90%</p>
                <div class="progress progress-bar-danger" style="height: 6px">
                  <div
                          class="progress-bar"
                          role="progressbar"
                          aria-valuenow="70"
                          aria-valuemin="70"
                          aria-valuemax="100"
                          style="width: 70%"
                  ></div>
                </div>
              </div>
              <div class="col-6">
                <p class="mb-50">Duration: 1yr</p>
                <div class="progress progress-bar-success" style="height: 6px">
                  <div
                          class="progress-bar"
                          role="progressbar"
                          aria-valuenow="90"
                          aria-valuemin="90"
                          aria-valuemax="100"
                          style="width: 90%"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Avg Sessions Chart Card ends -->

      <!-- Support Tracker Chart Card starts -->
      <div class="col-lg-6 col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between pb-0">
            <h4 class="card-title">Support Tracker</h4>
            <div class="dropdown chart-dropdown">
              <button
                      class="btn btn-sm border-0 dropdown-toggle p-50"
                      type="button"
                      id="dropdownItem4"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
              >
                Last 7 Days
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem4">
                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                <h1 class="font-large-2 font-weight-bolder mt-2 mb-0">163</h1>
                <p class="card-text">Tickets</p>
              </div>
              <div class="col-sm-10 col-12 d-flex justify-content-center">
                <div id="support-trackers-chart"></div>
              </div>
            </div>
            <div class="d-flex justify-content-between mt-1">
              <div class="text-center">
                <p class="card-text mb-50">New Tickets</p>
                <span class="font-large-1 font-weight-bold">29</span>
              </div>
              <div class="text-center">
                <p class="card-text mb-50">Open Tickets</p>
                <span class="font-large-1 font-weight-bold">63</span>
              </div>
              <div class="text-center">
                <p class="card-text mb-50">Response Time</p>
                <span class="font-large-1 font-weight-bold">1d</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Support Tracker Chart Card ends -->
    </div>

    <div class="row match-height d-none">
      <!-- Timeline Card -->
      <div class="col-lg-4 col-12">
        <div class="card card-user-timeline">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <i data-feather="list" class="user-timeline-title-icon"></i>
              <h4 class="card-title">User Timeline</h4>
            </div>
          </div>
          <div class="card-body">
            <ul class="timeline ml-50 mb-0">
              <li class="timeline-item">
                <span class="timeline-point timeline-point-indicator"></span>
                <div class="timeline-event">
                  <h6>12 Invoices have been paid</h6>
                  <p>Invoices are paid to the company</p>
                  <div class="media align-items-center">
                    <img class="mr-1" src="{{asset('images/icons/json.png')}}" alt="data.json" height="23" />
                    <h6 class="media-body mb-0">data.json</h6>
                  </div>
                </div>
              </li>
              <li class="timeline-item">
                <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                <div class="timeline-event">
                  <h6>Client Meeting</h6>
                  <p>Project meeting with Carl</p>
                  <div class="media align-items-center">
                    <div class="avatar mr-50">
                      <img
                              src="{{asset('images/portrait/small/avatar-s-9.jpg')}}"
                              alt="Avatar"
                              width="38"
                              height="38"
                      />
                    </div>
                    <div class="media-body">
                      <h6 class="mb-0">Carl Roy (Client)</h6>
                      <p class="mb-0">CEO of Infibeam</p>
                    </div>
                  </div>
                </div>
              </li>
              <li class="timeline-item">
                <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                <div class="timeline-event">
                  <h6>Create a new project</h6>
                  <p>Add files to new design folder</p>
                  <div class="avatar-group">
                    <div
                            data-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-placement="bottom"
                            data-original-title="Billy Hopkins"
                            class="avatar pull-up"
                    >
                      <img
                              src="{{asset('images/portrait/small/avatar-s-9.jpg')}}"
                              alt="Avatar"
                              width="33"
                              height="33"
                      />
                    </div>
                    <div
                            data-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-placement="bottom"
                            data-original-title="Amy Carson"
                            class="avatar pull-up"
                    >
                      <img
                              src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                              alt="Avatar"
                              width="33"
                              height="33"
                      />
                    </div>
                    <div
                            data-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-placement="bottom"
                            data-original-title="Brandon Miles"
                            class="avatar pull-up"
                    >
                      <img
                              src="{{asset('images/portrait/small/avatar-s-8.jpg')}}"
                              alt="Avatar"
                              width="33"
                              height="33"
                      />
                    </div>
                    <div
                            data-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-placement="bottom"
                            data-original-title="Daisy Weber"
                            class="avatar pull-up"
                    >
                      <img
                              src="{{asset('images/portrait/small/avatar-s-7.jpg')}}"
                              alt="Avatar"
                              width="33"
                              height="33"
                      />
                    </div>
                    <div
                            data-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-placement="bottom"
                            data-original-title="Jenny Looper"
                            class="avatar pull-up"
                    >
                      <img
                              src="{{asset('images/portrait/small/avatar-s-20.jpg')}}"
                              alt="Avatar"
                              width="33"
                              height="33"
                      />
                    </div>
                  </div>
                </div>
              </li>
              <li class="timeline-item">
                <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                <div class="timeline-event">
                  <h6>Update project for client</h6>
                  <p class="mb-0">Update files as per new design</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Timeline Card -->

      <!-- Sales Stats Chart Card starts -->
      <div class="col-lg-4 col-md-6 col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-start pb-1">
            <div>
              <h4 class="card-title mb-25">Sales</h4>
              <p class="card-text">Last 6 months</p>
            </div>
            <div class="dropdown chart-dropdown">
              <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-toggle="dropdown"></i>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="d-inline-block mr-1">
              <div class="d-flex align-items-center">
                <i data-feather="circle" class="font-small-3 text-primary mr-50"></i>
                <h6 class="mb-0">Sales</h6>
              </div>
            </div>
            <div class="d-inline-block">
              <div class="d-flex align-items-center">
                <i data-feather="circle" class="font-small-3 text-info mr-50"></i>
                <h6 class="mb-0">Visits</h6>
              </div>
            </div>
            <div id="sales-visit-chart" class="mt-50"></div>
          </div>
        </div>
      </div>
      <!-- Sales Stats Chart Card ends -->

      <!-- App Design Card -->
      <div class="col-lg-4 col-md-6 col-12">
        <div class="card card-app-design">
          <div class="card-body">
            <div class="badge badge-light-primary">03 Sep, 20</div>
            <h4 class="card-title mt-1 mb-75 pt-25">App design</h4>
            <p class="card-text font-small-2 mb-2">
              You can Find Only Post and Quotes Related to IOS like ipad app design, iphone app design
            </p>
            <div class="design-group mb-2 pt-50">
              <h6 class="section-label">Team</h6>
              <div class="badge badge-light-warning mr-1">Figma</div>
              <div class="badge badge-light-primary">Wireframe</div>
            </div>
            <div class="design-group pt-25">
              <h6 class="section-label">Members</h6>
              <div class="avatar">
                <img src="{{asset('images/portrait/small/avatar-s-9.jpg')}}" width="34" height="34" alt="Avatar" />
              </div>
              <div class="avatar bg-light-danger">
                <div class="avatar-content">PI</div>
              </div>
              <div class="avatar">
                <img
                        src="{{asset('images/portrait/small/avatar-s-14.jpg')}}"
                        width="34"
                        height="34"
                        alt="Avatar"
                />
              </div>
              <div class="avatar">
                <img src="{{asset('images/portrait/small/avatar-s-7.jpg')}}" width="34" height="34" alt="Avatar" />
              </div>
              <div class="avatar bg-light-secondary">
                <div class="avatar-content">AL</div>
              </div>
            </div>
            <div class="design-planning-wrapper mb-2 py-75">
              <div class="design-planning">
                <p class="card-text mb-25">Due Date</p>
                <h6 class="mb-0">12 Apr, 21</h6>
              </div>
              <div class="design-planning">
                <p class="card-text mb-25">Budget</p>
                <h6 class="mb-0">$49251.91</h6>
              </div>
              <div class="design-planning">
                <p class="card-text mb-25">Cost</p>
                <h6 class="mb-0">$840.99</h6>
              </div>
            </div>
            <button type="button" class="btn btn-primary btn-block">Join Team</button>
          </div>
        </div>
      </div>
      <!--/ App Design Card -->
    </div>

    <!-- List DataTable -->
    <div class="row d-none">
      <div class="col-12">
        <div class="card invoice-list-wrapper">
          <div class="card-datatable table-responsive">
            <table class="invoice-list-table table">
              <thead>
              <tr>
                <th></th>
                <th>#</th>
                <th><i data-feather="trending-up"></i></th>
                <th>Client</th>
                <th>Total</th>
                <th class="text-truncate">Issued Date</th>
                <th>Balance</th>
                <th>Invoice Status</th>
                <th class="cell-fit">Actions</th>
              </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--/ List DataTable -->
  </section>
  <!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
{{--  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>--}}
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
{{--  <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>--}}
  <script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
{{--  <script src="{{ asset(mix('js/scripts/cards/card-advance.js')) }}"></script>--}}
  <script>

    $(document).ready(function () {
      let _token = $('input[name=_token]').val()
      let add_filling_form = $('#add-filling-form')
      add_filling_form.submit(function (e) {
        e.preventDefault()
        $.ajax({
          url: add_filling_form.attr('action'),
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
              add_filling_form[0].reset()
              setTimeout(() => location.reload(), 1000)
              message('success', res.message)
            }
          }
        })
      })

      let profile_path = '{{ asset('images/profile/user-uploads/') }}'

      $.ajax({
        url: '/dashboard/filling',
        type: 'post',
        data: {_token: _token},
        success: function (res) {
          if (res) {
            $.each(res, function (k, v) {
              $('#'+k).val(v)
            })
            $('#fprogramme_id').filter(function () {
              return $('#fprogramme_id').val() === $('#fprogramme_id').val(res.programme_id)
            }).attr('selected', true)
            $('#eimage_loader').html(`<img src="${profile_path +'/'+ res.image}" width="80" height="80" style="border-radius: 100px" alt=""/>`)
            $('#save-edit').html('Save changes')
          }
        }
      })
    })


    var d = new Date();
    var time = d.getHours();

    let greeting = ''
    let greetings = $('#greetings')

    if (time < 12) {
      greetings.html(`<b>Good Morning!</b>`)
    }
    if (time == 12) {
      greetings.html(`<b>Good Noon!</b>`)
    }
    if (time > 12 && time < 15) {
      greetings.html(`<b>Good Afternoon!</b>`)
    }
    if (time > 15) {
      greetings.html(`<b>Good Evening!</b>`)
    }

    $(document).ready(function () {
      let _token = $('input[name=_token]').val()
      $.ajax({
        url: '{{ route('filling.count') }}',
        type: 'post',
        data: {_token: _token},
        success: function (res) {
          $('#count_fillings').html(res)
        }
      })
      $.ajax({
        url: '{{ route('payment.count') }}',
        type: 'post',
        data: {_token: _token},
        success: function (res) {
          $('#count_payments').html(res)
        }
      })
    })
  </script>
@endsection