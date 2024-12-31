@php
$configData = Helper::appClasses();
@endphp
<!-- Create App Modal -->
<div class="modal fade" id="createApp" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-simple modal-upgrade-plan">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center">
          <h4 class="mb-2">Create App</h4>
          <p class="mb-6">Provide data with this form to create your app.</p>
        </div>
        <!-- App Wizard -->
        <div id="wizard-create-app" class="bs-stepper vertical mt-2 shadow-none">
          <div class="bs-stepper-header border-0 p-1 pb-0">
            <div class="step" data-target="#details">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-circle"><i class="bx bx-home"></i></span>
                <span class="bs-stepper-label">
                  <span class="bs-stepper-title text-uppercase">Details</span>
                  <span class="bs-stepper-subtitle">Enter Details</span>
                </span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#frameworks">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-circle"><i class="bx bx-box"></i></span>
                <span class="bs-stepper-label">
                  <span class="bs-stepper-title text-uppercase">Frameworks</span>
                  <span class="bs-stepper-subtitle">Select Framework</span>
                </span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#database">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-circle"><i class="bx bx-data"></i></span>
                <span class="bs-stepper-label">
                  <span class="bs-stepper-title text-uppercase">Database</span>
                  <span class="bs-stepper-subtitle">Select Database</span>
                </span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#billing">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-circle"><i class="bx bx-credit-card"></i></span>
                <span class="bs-stepper-label">
                  <span class="bs-stepper-title text-uppercase">Billing</span>
                  <span class="bs-stepper-subtitle">Payment Details</span>
                </span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#submit">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-circle"><i class="bx bx-check"></i></span>
                <span class="bs-stepper-label">
                  <span class="bs-stepper-title text-uppercase">Submit</span>
                  <span class="bs-stepper-subtitle">Submit</span>
                </span>
              </button>
            </div>
          </div>
          <div class="bs-stepper-content p-1 pb-0">
            <form onSubmit="return false">
              <!-- Details -->
              <div id="details" class="content pt-4 pt-lg-0">
                <div class="mb-6">
                  <label for="exampleInputEmail1" class="form-label">Application Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Application Name">
                </div>
                <h5>Category</h5>
                <ul class="p-0 m-0">
                  <li class="d-flex align-items-start mb-4">
                    <div class="badge bg-label-info p-2 me-3 rounded"><i class="bx bx-file bx-30px"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                      <div class="me-2">
                        <h6 class="mb-1">CRM Application</h6>
                        <small>Scales with any business</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                          <input name="details-radio" class="form-check-input" type="radio" value="" />
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-start mb-4">
                    <div class="badge bg-label-success p-2 me-3 rounded"><i class="bx bx-cart bx-30px"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                      <div class="me-2">
                        <h6 class="mb-1">eCommerce Platforms</h6>
                        <small>Grow Your Business With App</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                          <input name="details-radio" class="form-check-input" type="radio" value="" checked />
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-start">
                    <div class="badge bg-label-danger p-2 me-3 rounded"><i class="bx bx-laptop bx-30px"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                      <div class="me-2">
                        <h6 class="mb-1">Online Learning platform</h6>
                        <small>Start learning today</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                          <input name="details-radio" class="form-check-input" type="radio" value="" />
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
                <div class="col-12 d-flex justify-content-between mt-6">
                  <button class="btn btn-label-secondary btn-prev" disabled> <i class="bx bx-left-arrow-alt bx-sm me-sm-2 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                  </button>
                  <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span> <i class="bx bx-right-arrow-alt bx-sm"></i></button>
                </div>
              </div>

              <!-- Frameworks -->
              <div id="frameworks" class="content pt-4 pt-lg-0">
                <h5>Select Framework</h5>
                <ul class="p-0 m-0">
                  <li class="d-flex align-items-start mb-4">
                    <div class="badge bg-label-info p-2 me-3 rounded"><i class="bx bxl-react bx-30px"></i></div>
                    <div class="d-flex justify-content-between w-100">
                      <div class="me-2">
                        <h6 class="mb-1">React Native</h6>
                        <small>Create truly native apps</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                          <input name="frameworks-radio" class="form-check-input" type="radio" value="" />
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-start mb-4">
                    <div class="badge bg-label-danger p-2 me-3 rounded"><i class="bx bxl-angular bx-30px"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                      <div class="me-2">
                        <h6 class="mb-1">Angular</h6>
                        <small>Most suited for your application</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                          <input name="frameworks-radio" class="form-check-input" type="radio" value="" checked="" />
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-start mb-4">
                    <div class="badge bg-label-success p-2 me-3 rounded"><i class="bx bxl-vuejs bx-30px"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                      <div class="me-2">
                        <h6 class="mb-1">Vue</h6>
                        <small>JS web frameworks</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                          <input name="frameworks-radio" class="form-check-input" type="radio" value="" />
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-start">
                    <div class="badge bg-label-warning p-2 me-3 rounded"><i class="bx bxl-html5 bx-30px"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                      <div class="me-2">
                        <h6 class="mb-1">HTML</h6>
                        <small>Progressive Framework</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                          <input name="frameworks-radio" class="form-check-input" type="radio" value="" checked />
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>

                <div class="col-12 d-flex justify-content-between mt-6">
                  <button class="btn btn-label-secondary btn-prev"> <i class="bx bx-left-arrow-alt bx-sm me-sm-2 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
                  <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span> <i class="bx bx-right-arrow-alt bx-sm"></i></button>
                </div>
              </div>

              <!-- Database -->
              <div id="database" class="content pt-4 pt-lg-0">
                <div class="mb-6">
                  <label for="exampleInputEmail2" class="form-label">Database Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Database Name">
                </div>
                <h5>Select Database Engine</h5>
                <ul class="p-0 m-0">
                  <li class="d-flex align-items-start mb-4">
                    <div class="badge bg-label-danger p-2 me-3 rounded"><i class="bx bxl-firebase bx-30px"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                      <div class="me-2">
                        <h6 class="mb-1">Firebase</h6>
                        <small>Cloud Firestone</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                          <input name="database-radio" class="form-check-input" type="radio" value="" />
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-start mb-4">
                    <div class="badge bg-label-warning p-2 me-3 rounded"><i class="bx bxl-amazon bx-30px"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                      <div class="me-2">
                        <h6 class="mb-1">AWS</h6>
                        <small>Amazon Fast NoSQL Database</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                          <input name="database-radio" class="form-check-input" type="radio" value="" checked />
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-start">
                    <div class="badge bg-label-info p-2 me-3 rounded"><i class="bx bx-data bx-30px"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                      <div class="me-2">
                        <h6 class="mb-1">MySQL</h6>
                        <small>Basic MySQL database</small>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                          <input name="database-radio" class="form-check-input" type="radio" value="" />
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
                <div class="col-12 d-flex justify-content-between mt-6">
                  <button class="btn btn-label-secondary btn-prev"> <i class="bx bx-left-arrow-alt bx-sm me-sm-2 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
                  <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span> <i class="bx bx-right-arrow-alt bx-sm"></i></button>
                </div>
              </div>

              <!-- billing -->
              <div id="billing" class="content">
                <h5 class="mb-6">Payment Details</h5>
                <div id="AppNewCCForm" class="row g-6 mb-6" onsubmit="return false">
                  <div class="col-12">
                    <label for="modalAppCardNumber" class="form-label">Card Number</label>
                    <div class="input-group input-group-merge">
                      <input class="form-control app-credit-card-mask" type="text" placeholder="1356 3215 6548 7898" aria-describedby="modalAppAddCard" id="modalAppCardNumber" />
                      <span class="input-group-text cursor-pointer" id="modalAppAddCard"><span class="app-card-type"></span></span>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <label for="modalAppUserName" class="form-label">Name on Card</label>
                    <input type="text" class="form-control" placeholder="John Doe" id="modalAppUserName" />
                  </div>
                  <div class="col-6 col-md-3">
                    <label for="modalAppExpiry" class="form-label">Expiry</label>
                    <input type="text" class="form-control app-expiry-date-mask" placeholder="MM/YY" id="modalAppExpiry" />
                  </div>
                  <div class="col-6 col-md-3">
                    <label for="modalAppAddCardCvv" class="form-label">CVV</label>
                    <div class="input-group input-group-merge">
                      <input type="text" id="modalAppAddCardCvv" class="form-control app-cvv-code-mask" maxlength="3" placeholder="654" />
                      <span class="input-group-text cursor-pointer" id="modalAppAddCardCvv2"><i class="text-muted bx bx-help-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Card Verification Value"></i></span>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-check form-switch my-2 ms-2">
                      <input type="checkbox" class="form-check-input" id="appFutureAddress" checked />
                      <label for="appFutureAddress" class="switch-label">Save card for future billing?</label>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-between mt-6">
                  <button class="btn btn-label-secondary btn-prev"> <i class="bx bx-left-arrow-alt bx-sm me-sm-2 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
                  <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span> <i class="bx bx-right-arrow-alt bx-sm"></i></button>
                </div>
              </div>

              <!-- submit -->
              <div id="submit" class="content text-center pt-4 pt-lg-0">
                <h5 class="mb-1">Submit</h5>
                <p class="small">Submit to kick start your project.</p>
                <!-- image -->
                <img src="{{asset('assets/img/illustrations/man-with-laptop.png')}}" alt="Create App img" width="163" class="img-fluid">
                <div class="col-12 d-flex justify-content-between mt-6">
                  <button class="btn btn-label-secondary btn-prev"> <i class="bx bx-left-arrow-alt bx-sm me-sm-2 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
                  <button class="btn btn-success btn-next btn-submit" data-bs-dismiss="modal" aria-label="Close"> <span class="align-middle">Submit</span></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--/ App Wizard -->
    </div>
  </div>
</div>
<!--/ Create App Modal -->
