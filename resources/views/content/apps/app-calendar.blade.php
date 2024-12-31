@extends('layouts/layoutMaster')

@section('title', 'Fullcalendar - Apps')

@section('vendor-style')
  @vite([
    'resources/assets/vendor/libs/fullcalendar/fullcalendar.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/quill/editor.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  ])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/app-calendar.scss'])
@endsection

@section('vendor-script')
  @vite([
    'resources/assets/vendor/libs/fullcalendar/fullcalendar.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/moment/moment.js',
  ])
@endsection

@section('page-script')
  @vite([
    'resources/assets/js/app-calendar-events.js',
    'resources/assets/js/app-calendar.js',
  ])
@endsection


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- dragging  -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

 <!-- Flatpickr JS -->
 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
  <!-- dragging  -->
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script> --}}

 <script>
     document.addEventListener("DOMContentLoaded", () => {
         flatpickr("#datepicker", {
             dateFormat: "Y-m-d",
         });
     });
     document.addEventListener("DOMContentLoaded", () => {
         flatpickr("#modaldate", {
             dateFormat: "Y-m-d",
         });
     });
     document.addEventListener("DOMContentLoaded", () => {
         flatpickr("#startdate", {
             dateFormat: "Y-m-d",
         });
     });
 </script>
 <script>  

  // jQuery menu code
  $(document).ready(function() {
      $('#menubar').click(function() {
          $('#slideMenu').toggleClass('slidin');
          $('#maindate').toggleClass('blacky');
          $('#crossicon').toggleClass('cross');
          $('#menuIcon').toggleClass('bar');
      });
      $('#maindate').click(function() {
          $('#slideMenu').removeClass('slidin');
          $('#maindate').removeClass('blacky');
          $('#crossicon').removeClass('cross');
          $('#menuIcon').removeClass('bar');
      });
  });
  $(document).ready(function () {
    $('.dr_three .dropdown-item').on('click', function () {
        if ($(this).hasClass('rsnone')) {
            $('#menubar').addClass('block');
            console.log('Class added to #menubar.');
        } else {
            $('#menubar').removeClass('block');
            console.log('Class removed from #menubar.');
        }
      });
  });
  $(document).ready(function () {
    // Add class to .dayactive .box_width when .fa-bars is clicked
    $('.fa-bars').on('click', function () {
        $('.dayactive .box_width').addClass('showdayactive');
    });

    // Remove class from .dayactive .box_width when .fa-times-circle is clicked
    $('.fa-times-circle').on('click', function () {
        $('.dayactive .box_width').removeClass('showdayactive');
    });
});


  $(document).ready(function() {
    $('.dr_three .dropdown-item').on('click', function() {
        const $eventBox = $('.event-box');
        if ($(this).hasClass('monthview')) {
            $eventBox.addClass('boxmonth'); // Add your desired class here
        } else {
            $eventBox.removeClass('boxmonth'); // Remove the class if other items are clicked
          }
      });
    });


  // Function to toggle the sidebar visibility
  function toggleSidebar() {
      const listMonthView = document.querySelector('.fc-listMonth-view.fc-view.fc-list.fc-list-sticky');
      const sidebar = document.getElementById('app-calendar-sidebar');

      if (sidebar) {
          // Show the sidebar if the specific element exists
          if (listMonthView) {
              sidebar.style.display = 'block';
          } else {
              sidebar.style.display = 'none';
          }
      }
  }
  $(document).ready(function() {
    $('.dr_three .dropdown-item').on('click', function() {
        const $dayblock = $(this);
        const $dayArea = $('.day_area');
        const $calandar = $('#calendar');
        const $maindate = $('#maindate');

        if ($(this).hasClass('dayview')) {
            $maindate.addClass('hidemaindate'); 
            $calandar.addClass('hidecalendar'); 
            $dayArea.addClass('dayactive');
            $dayblock.addClass('hideblock');
        } else {
            $maindate.removeClass('hidemaindate'); 
            $calandar.removeClass('hidecalendar'); 
            $dayArea.removeClass('dayactive'); 
            $dayblock.removeClass('hideblock');
        }
    });
});

  // Run the function on page load
  document.addEventListener('DOMContentLoaded', () => {
      toggleSidebar();

      // Check for DOM changes dynamically using MutationObserver
      const observer = new MutationObserver(() => toggleSidebar());
      const targetNode = document.body; // Ensure the body is valid
      if (targetNode instanceof Node) {
          observer.observe(targetNode, { childList: true, subtree: true });
      } else {
          console.error("Target node is not a valid DOM Node.");
      }
  });

</script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
      const menuItems = document.querySelectorAll('.dropdown-item'); // Select all dropdown items
      const sidebarToggleButton = document.querySelector('.fc-sidebarToggle-button'); // Select the button

      if (sidebarToggleButton) {
          menuItems.forEach(item => {
              item.addEventListener('click', (event) => {
                  // Prevent default behavior if necessary
                  event.preventDefault();

                  if (item.classList.contains('listbar')) {
                      // Add class if 'List' item is clicked
                      sidebarToggleButton.classList.add('sidebar'); // Replace 'your-class-name' with the desired class
                  } else {
                      // Remove class if any other item is clicked
                      sidebarToggleButton.classList.remove('sidebar');
                  }
              });
          });
      }
  });
</script>
<script> 
  document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("dragging");

    if (!container) {
      console.error("Container with id 'dragging' not found.");
      return;
    }

    const items = container.querySelectorAll(".timesitem");

    if (items.length === 0) {
      console.error("No elements with class 'timesitem' found.");
      return;
    }

    items.forEach(item => {
      item.addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("text/plain", e.target.id); // Store the ID of the dragged element
        e.target.classList.add("dragging");
      });

      item.addEventListener("dragend", (e) => {
        e.target.classList.remove("dragging");
      });
    });

    container.addEventListener("dragover", (e) => {
      e.preventDefault();
      const afterElement = getDragAfterElement(container, e.clientY);
      const draggable = document.querySelector(".dragging");

      if (draggable) {
        if (afterElement == null) {
          container.appendChild(draggable);
        } else {
          container.insertBefore(draggable, afterElement);
        }
      }
    });

    function getDragAfterElement(container, y) {
      const draggableElements = [...container.querySelectorAll(".timesitem:not(.dragging)")];

      return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        if (offset < 0 && offset > closest.offset) {
          return { offset: offset, element: child };
        } else {
          return closest;
        }
      }, { offset: Number.NEGATIVE_INFINITY }).element;
    }
  });

</script>


@section('content')
<div class="card app-calendar-wrapper">
  <div class="row g-0">

    <!-- Calendar area -->
    <div class="calander_section">
      <div class="calander_top">
        <div class="filter_area">
          <div class="dropdown dr_one">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              View options
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><div class="flexname">View by users</div> <div class="check"><i class="fas fa-check"></i></div></a></li>
              <li><a class="dropdown-item" href="#">View by jobs <div class="btn btnjob" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Learn More">
                <i class="far fa-circle-question"></i>
              </div></a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item listview" href="#"><i class="fa-solid fa-list"></i> List view</a></li>
              <li><hr class="dropdown-divider"></li>
              <li class="drinside">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="flexname">Sort shift</div> <div class="check"><i class="fas fa-angle-right"></i></div>
                </button>
                <ul class="dropdown-menu dropend">
                  <li><a class="dropdown-item" href="#"><div class="flexname">Sort by time</div> <div class="check"><i class="fas fa-check"></i></div></a></li>
                  <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                  <li><a class="dropdown-item listview" href="#"> Sort by shit title</a></li>
                </ul>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <div class="form-check form-switch">
                  <label class="form-check-label" for="flexSwitchCheckChecked">Minimized view</label>
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                </div>
              </li>
              <li>
                <div class="form-check form-switch">
                  <label class="form-check-label" for="flexSwitchCheckChecked2">Availability status</label>
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked2" checked>
                </div>
              </li>
            </ul>
          </div>
          <div class="dropdown dr_two">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-sort-amount-down-alt"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Day</a></li>
              <li><a class="dropdown-item" href="#">Week</a></li>
              <li><a class="dropdown-item" href="#">Month</a></li>
            </ul>
          </div>
          <div class="dropdown dr_three">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Week
            </button>
            <ul class="dropdown-menu fit_content">
              <li><a class="dropdown-item dayview" href="#">Day</a></li>
              <li><a class="dropdown-item" href="#">Week</a></li>
              <li><a class="dropdown-item rsnone monthview" href="#">Month</a></li>
              <li><a class="dropdown-item rsnone listbar" href="#">List</a></li>
            </ul>
          </div>
          <div class="dropdown dr_four">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="past_month"><i class="fas fa-chevron-left"></i></div>
              <div class="datepick" id="datepicker">Dec 16-22</div>
              <div class="next_month"><i class="fas fa-chevron-right"></i></div>
            </button>
          </div>
          <button type="button" class="btn dr_five"
                  data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip"
                  data-bs-title="Show Today">
                  <i class="fas fa-calendar-day"></i>
          </button>
        </div>
        <div class="button_area">
          <div class="dropdown dr_six">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Actions
            </button>
            <ul class="dropdown-menu">
              <li><span class="titlesmall">Weeks Actions</span></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-eye-slash"></i></div> Unpublish week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-user-slash"></i></div> Unassign week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-file-export"></i></div> Export week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-print"></i></div> print week</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><span class="titlesmall">Template</span></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
            </ul>
          </div>
          <div class="dropdown dr_seven">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Add
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Add single shift</a></li>
              <li><a class="dropdown-item" href="#">Add multiple shifts</a></li>
              <li><a class="dropdown-item" href="#">Import shifts sfrom Excel</a></li>
              <li><a class="dropdown-item" href="#">Add from shift templates</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Add unavailability</a></li>
              <li><a class="dropdown-item" href="#">Add time off</a></li>
            </ul>
          </div>
          <div class="dropdown dr_eight">
            <button class="btn dropdown-toggle" type="button" disabled data-bs-toggle="dropdown" aria-expanded="false">
              Publish
            </button>
          </div>
        </div>
      </div>
            {{-- modal  --}}
            <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Tuesday, Dec 17, 2024</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
                <div class="offcanvas-body">
                  <ul class="nav nav-tabs" 
                  id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" 
                          id="shiftdetail-tab" 
                          data-bs-toggle="tab" data-bs-target="#shiftdetail" 
                          type="button" role="tab" 
                          aria-controls="shiftdetail" aria-selected="true"><i class="far fa-file-alt"></i> Shift details
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" 
                          id="template-tab" 
                          data-bs-toggle="tab" data-bs-target="#template" 
                          type="button" role="tab" 
                          aria-controls="template" aria-selected="false"><i class="far fa-bell"></i> Shift tasks
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" 
                          id="tasks-tab" 
                          data-bs-toggle="tab" data-bs-target="#tasks" 
                          type="button" role="tab" 
                          aria-controls="tasks" aria-selected="false"><i class="fas fa-link"></i> Templates
                  </button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="shiftdetail" 
                    role="tabpanel" aria-labelledby="shiftdetail-tab">
                  <div class="shift_ditail">
                    <div class="date_shift">
                      <div class="date_item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Date</span>
                      </div>
                      <div class="date_item">
                        <button type="button" class="btn" id="modaldate">
                          12/17/2024 <i class="fas fa-caret-down"></i>
                        </button>
                      </div>
                      <div class="date_item">
                        <span>All day</span>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        </div>
                      </div>
                    </div>
                    <div class="date_shift">
                      <div class="date_item">
                        <div class="start">
                          <i class="far fa-clock"></i>
                          <span>Start</span>
                        </div>
                        <div class="startend">
                          <input type="text" name="timefrom" class="form-control" value="9:00">
                          <div class="ampm">
                            <p>am</p>
                            <p class="active">pm</p>
                          </div>
                        </div>
                        <div class="startend">
                          <input type="text" name="timefrom" class="form-control" value="01:00">
                          <div class="ampm">
                            <p>am</p>
                            <p class="active">pm</p>
                          </div>
                        </div>
                      </div>
                      <div class="date_item">
                        <p>08:00 Hours</p>
                      </div>
                    </div>
                    <div class="btn_shift">
                      <a href="#"><i class="fa-solid fa-cart-plus"></i> Add break</a>
                      <a href="#"><i class="fa-solid fa-repeat"></i> Does not repeat</a>
                      <a href="#"><i class="fa-solid fa-globe"></i> America/New_York <span data-bs-toggle="tooltip" data-bs-title="Learn More"><i class="fa-solid fa-question"></i></span></a>
                    </div>
                    <div class="form_shift">
                      {{-- <div class="form_group">
                        <div class="titleinput"><p>Shift title</p></div>
                        <div class="forminput"><input type="text" class="form-control" placeholder="Type here"></div>
                      </div> --}}
                      <div class="form_group">
                        <div class="titleinput"><p>Client Name</p></div>
                        <div class="forminput">
                          <div class="forminput"><input type="text" class="form-control" placeholder="Type here" value="Sharah Smith"></div>
                          <div class="dropdown colormenu">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <div class="selected_color"></div>
                            </button>
                            <ul class="dropdown-menu colordropdown">
                              <li><a class="dropdown-item" href="#"><div class="maincolor colorone"></div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="maincolor colortwo"></div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="maincolor colorthree"></div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="maincolor colorfour"></div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="maincolor colorfive"></div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="maincolor colorone"></div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="maincolor colortwo"></div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="maincolor colorthree"></div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="maincolor colorfour"></div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="maincolor colorfive"></div></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="form_group flexend relativeflex">
                        <div class="add_another_item" data-bs-toggle="collapse" data-bs-target="#Item" aria-expanded="false" aria-controls="Item">
                          <div class="item_title">
                            <i class="fas fa-plus"></i>
                          <p>Add Another Item</p>
                          </div>
                        </div>
                          <!-- Item -->
                        <div class="collapse item_collapse" id="Item">
                            <div class="accordion accordion-flush" id="itemac">
                              <div class="accordion-item">
                                <div class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <div class="jobitem">
                                    <i class="fas fa-angle-up"></i>
                                    <p>New job</p>
                                    </div>
                                    <div class="deleteitem"><i class="far fa-trash-alt"></i></div>
                                  </button>
                                </div>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#itemac">
                                  <div class="job_item">
                                    <div class="item_dr">
                                      <p>Service</p>
                                      <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                          2 Dogs / Initial Clean-Up
                                        </button>
                                        <ul class="dropdown-menu fit_content">
                                          <li><a class="dropdown-item" href="#">2 Dogs / Initial Clean-Up</a></li>
                                          <li><a class="dropdown-item" href="#">1 Dogs / Initial Clean-Up</a></li>
                                          <li><a class="dropdown-item" href="#">3 Dogs / Initial Clean-Up</a></li>
                                        </ul>
                                      </div>
                                    </div>
                                    <div class="item_dr">
                                      <p>Service Extras</p>
                                      <input type="text" class="form-control" placeholder="Extra Sevice">
                                    </div>
                                    <div class="flex_item">
                                      <div class="item_time">
                                        <p>Clean-up Time</p>
                                        <input type="text" class="form-control" value="10 minutes">
                                      </div>
                                      <div class="item_time">
                                        <p>Clean-up Time</p>
                                        <input type="text" class="form-control" value="10 minutes">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="accordion-item">
                                <div class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <div class="jobitem">
                                      <i class="fas fa-angle-up"></i>
                                      <p>New Booking</p>
                                    </div>
                                    <div class="deleteitem"><i class="far fa-trash-alt"></i></div>
                                  </button>
                                </div>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#itemac">
                                  <div class="booking_area">
                                    <div class="item_book">
                                      <p>Service</p>
                                      <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                          <span>Tooth Whitening</span>
                                          <i class="fas fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu fit_content">
                                          <li><a class="dropdown-item" href="#">One</a></li>
                                          <li><a class="dropdown-item" href="#">Two</a></li>
                                          <li><a class="dropdown-item" href="#">Three</a></li>
                                        </ul>
                                      </div>
                                    </div>
                                    
                                    <div class="item_book">
                                      <p>Service Extras</p>
                                      <input type="text" class="form-control" placeholder="Click here to select...">
                                    </div>
                                    <div class="item_book">
                                      <div class="item_flex">
                                        <div class="item_status">
                                          <p>Agent</p>
                                          <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                              <span>John Mayers</span>
                                              <i class="fas fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu fit_content">
                                              <li><a class="dropdown-item" href="#">One</a></li>
                                              <li><a class="dropdown-item" href="#">Two</a></li>
                                              <li><a class="dropdown-item" href="#">Three</a></li>
                                            </ul>
                                          </div>
                                        </div>
                                        <div class="item_status">
                                          <p>Status</p>
                                          <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                              <span>Approved</span>
                                              <i class="fas fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu fit_content">
                                              <li><a class="dropdown-item" href="#">One</a></li>
                                              <li><a class="dropdown-item" href="#">Two</a></li>
                                              <li><a class="dropdown-item" href="#">Three</a></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    
                                    <div class="item_book">
                                      <div class="item_flex">
                                        <div class="item_status">
                                          <p>Start Date</p>
                                          <input type="text" class="form-control" placeholder="12/25/2025" id="startdate">
                                        </div>
                                        <div class="item_status">
                                          <p>Availability</p>
                                          <button type="button" class="btn available"><span>Availability</span><i class="fas fa-arrow-right"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="item_book">
                                      <div class="item_flex">
                                        <div class="item_status">
                                          <p>Start Time</p>
                                          <div class="startend">
                                            <input type="text" name="timefrom" class="form-control" value="10:00">
                                            <div class="ampm">
                                              <p class="active">am</p>
                                              <p>pm</p>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="item_status">
                                          <p>End Time</p>
                                          <div class="startend">
                                            <input type="text" name="timefrom" class="form-control" value="10:00">
                                            <div class="ampm">
                                              <p class="active">am</p>
                                              <p>pm</p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="item_book">
                                      <div class="item_flex">
                                        <div class="item_status">
                                          <p>Beffer Before</p>
                                          <input type="text" class="form-control" value="10 minutes">
                                        </div>
                                        <div class="item_status">
                                          <p>Beffer After</p>
                                          <input type="text" class="form-control" value="10 minutes">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
      
      
                        </div>
                      </div>
                      <div class="form_group userinfo">
                        <div class="titleinput"><p>jobs (s)</p></div>
                        <div class="forminput jobsslide">
                          <div class="item_box">
                            <div class="collapse_box" data-bs-toggle="collapse" data-bs-target="#prcollapses" aria-expanded="false" aria-controls="prcollapses">
                              <div class="img_inside"><img src="{{asset ('/assets/img/provile.webp') }}"></div>
                              <div class="job_content">
                                <i class="fas fa-minus-circle"></i>
                                <h5>2 Dogs / Initial Clean-Up</h5>
                                <span>Today, 10:00am</span>
                              </div>
                            </div>
                          </div>
                          <div class="item_box">
                            <div class="ac_collapse">
                              
                            </div>
                            <div class="collapse_box">
                              <div class="img_inside"><img src="{{asset ('/assets/img/provile.webp') }}"></div>
                              <div class="job_content">
                                <i class="fas fa-minus-circle"></i>
                                <h5>2 Dogs / Initial Clean-Up</h5>
                                <span>Today, 10:00am</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form_group userinfo">
                        <div class="titleinput"><p>Tech (s)</p> <i class="fa-regular fa-circle-question" data-bs-toggle="tooltip" data-bs-title="learn More"></i></div>
                        <div class="forminput">
                          <div class="dropdown flex_btn">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <div class="user_btn">Mike Jones <i class="fas fa-times"></i></div>
                              <div class="user_btn"><i class="fas fa-plus"></i> Add users</div>
                              <div class="delete_btn"><i class="far fa-trash-alt" data-bs-toggle="tooltip" data-bs-title="learn More"></i></div>
                            </button>
                            <ul class="dropdown-menu">
                              <div class="job_area">
                                <div class="job_input">
                                  <input type="text" class="form-control" name="userinner" placeholder="Search user or Smart groups">
                                  <i class="fas fa-search"></i>
                                </div>
                                <div class="usertitle">All users</div>
                                <li class="user_info">
                                    <a href="#" class="dropdown-item">
                                      <div class="user_img">N</div>
                                      <h5>User name</h5>
                                      <button type="button" class="btn">Available</button>
                                      <div class="user_time"><i class="far fa-clock"></i> <span>00:30</span></div>
                                    </a> 
                                </li>
                                <li class="user_info">
                                  <a href="#" class="dropdown-item">
                                    <div class="user_img">P</div>
                                    <h5>User name</h5>
                                    <button type="button" class="btn">Available</button>
                                    <div class="user_time"><i class="far fa-clock"></i> <span>00:30</span></div>
                                  </a> 
                                </li>
                              </div>
                            </ul>
                          </div>
                          <div class="allusershift">
                            <p><i class="fas fa-unlink"></i> users qualified for this shift</p>
                            <span class="edituser">Edit</span>
                          </div>
                          <div class="allusershift shifttwo">
                            <p>How many open spots to claim</p>
                            <input type="text" class="form-control" value="1">
                          </div>
                          <div class="allusershift checkshift">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" checked id="checkshift">
                              <label class="form-check-label" for="checkshift">
                                Enable users to claim this shift
                              </label>
                              <div class="infoask"><i class="far fa-circle-question" data-bs-toggle="tooltip" data-bs-title="learn More"></i></div>
                            </div>
                          </div>
                          <div class="allusershift checkshift">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="checkshift2">
                              <label class="form-check-label" for="checkshift2">
                                Require admin approval for claimed shifts
                              </label>
                              <div class="infoask"><i class="far fa-circle-question" data-bs-toggle="tooltip" data-bs-title="learn More"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form_group">
                        <div class="titleinput"><p>Location</p></div>
                        <div class="forminput locationarea">
                          <input type="text" class="form-control" placeholder="Type Locaiton" value="181 Mickey Mouse Ln, Orlando, FL 90210">
                          <div class="textlock"><i class="fas fa-unlock-alt"></i></div>
                        </div>
                      </div>
                      <div class="form_group note">
                        <div class="titleinput"><p>Note</p></div>
                        <div class="forminput">
                          <textarea class="form-control" placeholder="Type here" rows="6" >Good morning! please make sure to- 1. Turn on all light, air-conditioning and TV's.  2. Fill the deposit sheet
                            Have a great shift</textarea>
                        </div>
                      </div>
                      <div class="bottom_shift">
                        <div class="shift_task">
                          <p>Shift tasks</p>
                          <div class="complete"><div class="circletaks"></div> <p><span>0</span> / 4 Tasks complete</p></div>
                        </div>
                        <button type="button" class="btn">Add tasks</button>
                      </div>
                    </div>
                  </div>
                  <div class="save_shift">
                    <div class="publish_area">
                      <div class="btn-inside" role="group">
                        <button type="button" class="btn bgcolor"><span data-bs-toggle="tooltip" data-bs-title="Default tooltip">Publish</span> <i class="far fa-bell" data-bs-toggle="tooltip" data-bs-title="Default tooltip"></i></button>
                        
                      </div>
                      <div class="btn-inside" role="group">
                        <button type="button" class="btn draftdelete" data-bs-toggle="tooltip" data-bs-title="Default tooltip"><span>Save draft</span></button>
                      </div>
                      <div class="btn-inside" role="group">
                        <button type="button" class="btn draftdelete"><i class="far fa-trash-alt"></i></button>
                      </div>
                    </div>
                    <div class="save_area">
                      <div class="btn-inside" role="group">
                        <button type="button" class="btn draftdelete"><i class="fas fa-arrow-circle-down"></i> save as template</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" 
                    id="template" 
                    role="tabpanel" aria-labelledby="template-tab">
                  <div class="tasks_area">
                    <div class="img_tasks">
                      <img src="{{asset ('/assets/img/placeholder-tasks.svg') }}">
                    </div>
                    <div class="content_tasks">
                      <h3>No tasks to display</h3>
                      <p>Shift tasks are great way to let your users know what you expect them to do while in the shift</p>
                      <h6>Start by adding your first task</h6>
                      <button type="button" class="btn"><i class="fas fa-plus"></i> Add new task</button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" 
                    id="tasks" 
                    role="tabpanel" aria-labelledby="tasks-tab">
                  <div class="template_area">
                    <div class="searcht">
                      <input type="text" class="form-control">
                      <i class="fas fa-search"></i>
                    </div>
                    <div class="temp_inside">
                      <div class="box_temp">
                        <div class="box_conent">
                          <p>8a - 12p</p>
                          <span>Morning shift</span>
                        </div>
                        <div class="dropdown">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item" href="#">Delete</a></li>
                            <li><a class="dropdown-item" href="#">Duplicate</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="box_temp temp2">
                        <div class="box_conent">
                          <p>8a - 12p</p>
                          <span>Morning shift</span>
                        </div>
                        <div class="dropdown">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item" href="#">Delete</a></li>
                            <li><a class="dropdown-item" href="#">Duplicate</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
            {{-- end modal  --}}
      
            {{-- daily note  --}}
            
            <div class="notemodal offcanvas offcanvas-end" tabindex="-1" id="dailynote" aria-labelledby="dailynoteLabel" aria-modal="true" role="dialog">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="dailynoteLabel">Daily info: Mon, Dec 23, 2024</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <div class="daily_note">
                  <h4 class="titlenote">Daily note</h4>
                  <p class="note">Details and instructions to keep your team prepared for the day.</p>
                  <div class="box_note">
                    <div class="input_title">
                      <input type="text" class="form-control" placeholder="Type title">
                    </div>
                    <div class="description_note">
                      <span>Note Description</span>
                      <textarea class="details" class="form-control" rows="6" placeholder="Type description"></textarea>
                      <label for="fileInput" class="custom-file-upload">
                        <i class="fa-solid fa-paperclip"></i> Attach
                      </label>
                      <input type="file" id="fileInput" style="display:none;">
                    </div>
                    <div class="description_note">
                      <span>Who can see this</span>
                      <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          All users group
                        </button>
                            <ul class="dropdown-menu">
                              <div class="note_dr" onclick="event.stopPropagation();">
                                <ul class="nav nav-tabs" 
                                id="myTab" role="tablist">
                                  <li class="nav-item" role="presentation">
                                    <button class="nav-link active" 
                                        id="group-tab" 
                                        data-bs-toggle="tab" data-bs-target="#group" 
                                        type="button" role="tab" 
                                        aria-controls="group" aria-selected="true">group
                                    </button>
                                  </li>
                                  <li class="nav-item" role="presentation">
                                    <button class="nav-link" 
                                            id="Users-tab" 
                                            data-bs-toggle="tab" data-bs-target="#Users" 
                                            type="button" role="tab" 
                                            aria-controls="Users" aria-selected="false">Users
                                    </button>
                                  </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                  <div class="tab-pane show active" 
                                      id="group" 
                                      role="tabpanel" aria-labelledby="group-tab">
                                    <div class="group_area">
                                      <div class="search_group">
                                        <input type="text" class="form-control" placeholder="Search groups">
                                        <i class="fas fa-search"></i>
                                      </div>
                                      <div class="checkgroup">
                                        <div class="input-group-text">
                                          <input class="form-check-input" checked id="groupone" type="checkbox" value="" aria-label="input">
                                          <label for="groupone"><i class="fa-solid fa-users"></i> <span class="groupspan">All users group</span></label>
                                        </div>
                                        <div class="input-group-text">
                                          <input class="form-check-input" id="grouptwo" type="checkbox" value="" aria-label="input">
                                          <label for="grouptwo"><i class="fa-solid fa-users"></i> <span class="groupspan">All users group</span></label>
                                        </div>
                                        <div class="input-group-text">
                                          <input class="form-check-input" id="groupthree" type="checkbox" value="" aria-label="input">
                                          <label for="groupthree"><i class="fa-solid fa-users"></i> <span class="groupspan">All users group</span></label>
                                        </div>
                                        <div class="input-group-text">
                                          <input class="form-check-input" id="groupfour" type="checkbox" value="" aria-label="input">
                                          <label for="groupfour"><i class="fa-solid fa-users"></i> <span class="groupspan">All users group</span></label>
                                        </div>
                                        <div class="input-group-text">
                                          <input class="form-check-input" id="groupfive" type="checkbox" value="" aria-label="input">
                                          <label for="groupfive"><i class="fa-solid fa-users"></i> <span class="groupspan">All users group</span></label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="tab-pane" 
                                      id="Users" 
                                      role="tabpanel" aria-labelledby="Users-tab">
                                      <div class="group_area">
                                        <div class="search_group">
                                          <input type="text" class="form-control" placeholder="Search users">
                                          <i class="fas fa-search"></i>
                                        </div>
                                        
                                        <div class="checkgroup">
                                          <div class="input-group-text">
                                            <input class="form-check-input" checked id="userone" type="checkbox" value="" aria-label="input">
                                            <label for="userone"> <span class="groupspan">Select all</span></label>
                                          </div>
                                          <div class="input-group-text">
                                            <input class="form-check-input" id="userTwo" type="checkbox" value="" aria-label="input">
                                            <label for="userTwo"><div class="usersprofile usersprofiletwo">U</div> <span class="groupspan">Chad Brooksville</span></label>
                                          </div>
                                          <div class="input-group-text">
                                            <input class="form-check-input" id="userThree" type="checkbox" value="" aria-label="input">
                                            <label for="userThree"><div class="usersprofile usersprofilethree">U</div> <span class="groupspan">
                                              Mike Jones</span></label>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                                
                              <div class="bottom_group">
                                <p>All users group</p>
                                <button type="button" class="btn reset">Reset</button>
                              </div>
                            </div>
                          </ul>
                      </div>
                    </div>
                    <div class="savenot">
                      <button type="button" class="btn">Discard</button>
                      <button type="button disable" class="btn" disabled>Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      
            {{-- end daily note  --}}

      {{-- main boxes  --}}
      <div class="left_bar" id="menubar">
        <i class="fas fa-bars" id="menuIcon"></i>
        <i class="far fa-times-circle" id="crossicon"></i>
      </div>
      <button type="button" title="Sidebar" aria-pressed="false" class="btn fc-sidebarToggle-button fc-button d-lg-none ps-0" data-bs-toggle="sidebar" data-overlay="" data-target="#app-calendar-sidebar"><i class="bx bx-menu bx-md text-heading"></i></button>
      <div class="main_box">
        <!-- Calendar Sidebar -->
        <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
          <div class="border-bottom p-6 my-sm-0 mb-4">
            <button class="btn btn-primary btn-toggle-sidebar w-100" data-bs-toggle="offcanvas" data-bs-target="#addEventSidebar" aria-controls="addEventSidebar">
              <i class="bx bx-plus bx-16px me-2"></i>
              <span class="align-middle">Add Event</span>
            </button>
          </div>
          <div class="px-3 pt-2">
            <!-- inline calendar (flatpicker) -->
            <div class="inline-calendar"></div>
          </div>
          <hr class="mb-6 mx-n4 mt-3">
          <div class="px-6 pb-2">
            <!-- Filter -->
            <div>
              <h5>Event Filters</h5>
            </div>

            <div class="form-check form-check-secondary mb-5 ms-2">
              <input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all" checked>
              <label class="form-check-label" for="selectAll">View All</label>
            </div>

            <div class="app-calendar-events-filter text-heading">
              <div class="form-check form-check-danger mb-5 ms-2">
                <input class="form-check-input input-filter" type="checkbox" id="select-personal" data-value="personal" checked>
                <label class="form-check-label" for="select-personal">Personal</label>
              </div>
              <div class="form-check mb-5 ms-2">
                <input class="form-check-input input-filter" type="checkbox" id="select-business" data-value="business" checked>
                <label class="form-check-label" for="select-business">Business</label>
              </div>
              <div class="form-check form-check-warning mb-5 ms-2">
                <input class="form-check-input input-filter" type="checkbox" id="select-family" data-value="family" checked>
                <label class="form-check-label" for="select-family">Family</label>
              </div>
              <div class="form-check form-check-success mb-5 ms-2">
                <input class="form-check-input input-filter" type="checkbox" id="select-holiday" data-value="holiday" checked>
                <label class="form-check-label" for="select-holiday">Holiday</label>
              </div>
              <div class="form-check form-check-info ms-2">
                <input class="form-check-input input-filter" type="checkbox" id="select-etc" data-value="etc" checked>
                <label class="form-check-label" for="select-etc">ETC</label>
              </div>
            </div>
          </div>
        </div>
        <!-- /Calendar Sidebar -->
        <!-- week item -->
          <div class="box_item box_width" id="slideMenu">
            <div class="top_title">
              <div class="search_inside">
                <input type="text" class="form-control" id="search" placeholder="Search users">
                <button type="submit" class="btn search_btn"><i class="fas fa-search"></i></button>
              </div>
              <div class="sort_icon"><i class="fas fa-sort"></i></div>
            </div>
            <div class="body_item infoheight">
              <div class="flex_info"><i class="far fa-file-alt"></i> <p>Daily info</p></div>
            </div>
            <div class="body_item">
              <div class="flex_info"><p>Unassigned shifts</p> <i class="fas fa-magic"></i></div>
            </div>
            <div class="body_item userheight">
              <div class="flex_info">
                <div class="user_profile"><img src="{{asset ('/assets/img/provile.webp')}} "></div>
                <div class="detail_user">
                  <p>Mike Jones</p>
                  <div class="detailinfo">
                    <i class="far fa-clock"></i>
                    <span>01:30</span>
                    <span class="number_profile">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                      3</span>
                      
                      <div class="box_pr">
                        <div class="titlepr"><h4>Mike's totals</h4></div>
                        <div class="box_content">
                          <div class="content_item">
                            <p>Published shifts</p>
                            <div class="item_number">
                              <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                                3</span>
                            </div>
                            <p class="item_number">
                              <i class="far fa-clock"></i>
                              <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                            </p>
                          </div>
                          
                          <div class="content_item bnone">
                            <p>Draft shifts</p>
                            <div class="item_number">
                              <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                                3</span>
                            </div>
                            <p class="item_number">
                              <i class="far fa-clock"></i>
                              <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                            </p>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="dropdown dropend userbtn">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                  </button>
                  <ul class="dropdown-menu">
                    <li><span class="titlesmall">Weeks Actions</span></li>
                    <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                    <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                    <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><span class="titlesmall">Template</span></li>
                    <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                    <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info">
                <div class="user_profile"><img src="{{asset ('/assets/img/provile.webp')}}"></div>
                <div class="detail_user">
                  <p>Mike Jones</p>
                  <div class="detailinfo">
                    <i class="far fa-clock"></i>
                    <span>01:30</span>
                    <span class="number_profile">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                      3</span>
                      <div class="box_pr">
                        <div class="titlepr"><h4>Mike's totals</h4></div>
                        <div class="box_content">
                          <div class="content_item">
                            <p>Published shifts</p>
                            <div class="item_number">
                              <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                                3</span>
                            </div>
                            <p class="item_number">
                              <i class="far fa-clock"></i>
                              <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                            </p>
                          </div>
                          
                          <div class="content_item bnone">
                            <p>Draft shifts</p>
                            <div class="item_number">
                              <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                                3</span>
                            </div>
                            <p class="item_number">
                              <i class="far fa-clock"></i>
                              <span data-bs-toggle="tooltip" data-bs-title="Total works hour">--</span>
                            </p>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="dropdown dropend userbtn">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                  </button>
                  <ul class="dropdown-menu">
                    <li><span class="titlesmall">Weeks Actions</span></li>
                    <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                    <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                    <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><span class="titlesmall">Template</span></li>
                    <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                    <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          {{-- end item  --}}
          <div class="date_items" id="maindate">
            <div class="box_item">
              <div class="top_title day_week">
                <div class="day_details">
                  <div class="name_week">
                    <p>Mon 12/16</p>
                    <div class="dropdown dropend">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                      </button>
                      <ul class="dropdown-menu">
                        <li><span class="titlesmall">Weeks Actions</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="titlesmall">Template</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="detailinfo">
                    <i class="far fa-clock"></i>
                    <span>01:30</span>
                    <span class="number_profile">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg> 3</span>
                    <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                    <div class="box_pr downbox">
                      <div class="titlepr"><h4>Day totals</h4></div>
                      <div class="box_content">
                        <div class="content_item notop">
                          <p>Published shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Draft shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Assigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item noborder">
                          <p>Unassigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item infoheight">
                <div class="flex_info iconbtn">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#dailynote" aria-controls="dailynote"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item userheight">
                <div class="flex_info boxtime" id="dragging">
                    <div class="timesitem bg_one" id="item1" draggable="true">
                      <div class="times">
                        <p class="white_p">8:30a - 9:15a</p>
                        <div class="dropdown dropend">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-square"></i></div> Select <div class="ctr">Ctrl + Shift + S</div></a></li>
                            <li class="dropdown drinside drbottom">
                              <a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-plus"></i></div> Asssign users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                              <ul class="dropdown-menu dropend group_dr">
                                <div class="group_user">
                                  <div class="list_agroup">
                                    <div class="searchuser">
                                      <input type="text" placeholder="Search users or smart groups" class="form-control">
                                      <i class="fas fa-search"></i>
                                    </div>
                                    <div class="all_usears">
                                      <span class="lightcolor">Qualified users</span>
                                        <div class="group_item">
                                          
                                          <input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for following text input">
                                          <div class="group_pr"><img src="{{asset ('/assets/img/provile.webp') }}"></div>
                                          <p data-bs-toggle="tooltip" data-bs-title="Chad Brooks">Chad Brooks</p>
                                          <div class="group_btn">
                                            <button type="button" class="btn">Available</button>
                                          </div>
                                          <div class="timegroup"><i class="far fa-clock"></i> 00:00</div>
                                        </div>
                                        <div class="group_item">
                                          
                                          <input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for following text input">
                                          <div class="group_pr"><img src="{{asset ('/assets/img/provile.webp') }}"></div>
                                          <p data-bs-toggle="tooltip" data-bs-title="Chad Brooks">Mike Jones</p>
                                          <div class="group_btn">
                                            <button type="button" class="btn">Available</button>
                                          </div>
                                          <div class="timegroup"><i class="far fa-clock"></i> 00:45</div>
                                        </div>
                                      <span class="lightcolor">Other users</span>
                                    </div>
                                  </div>
                                  <div class="save_btn"><button type="button" class="btn btnsave">Save</button></div>
                                </div>
                              </ul>
                            </li>
                            <li class="dropdown drinside">
                              <a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-graduation-cap"></i></div> Allocate users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                              <ul class="dropdown-menu dropend locate_job">
                                <div class="locate_inside">
                                  <div class="list_agroup">
                                    <div class="searchuser">
                                      <input type="text" placeholder="Search jobs" class="form-control">
                                      <i class="fas fa-search"></i>
                                    </div>
                                    <div class="joblocate">
                                      <div class="locate_item">
                                        <div class="circle cone"></div>
                                        <p>No Job</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle ctwo"></div>
                                        <p>1 Dog / Inital Clean-Up</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle cthree"></div>
                                        <p>2 Dogs / Inital Clean-Up</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle cfour"></div>
                                        <p>3 Dog / Inital Clean-Up</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle cfive"></div>
                                        <p>4 Dog/ Inital Clean-Up</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="save_btn"><button type="button" class="btn btnsave">Save</button></div>
                                </div>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-slash"></i></div> Duplicate <div class="check"><i class="fa-regular fa-circle-question"  data-bs-toggle="tooltip" data-bs-title="Lern More"></i></div></a></li>
                            <li class="dropdown drinside">
                              <a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-clone"></i></div> Multi duplicate <div class="check"><i class="fas fa-angle-right"></i></div></a>
                              <ul class="dropdown-menu dropend">
                                <div class="multi_duplicate">
                                  <input type="text" placeholder="0" class="form-control" value="2">
                                  <button type="button" class="btn btnmulti">Duplicate</button>
                                </div>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-slash"></i></div> Unassign</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-comments"></i></div> Start chat</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-square-minus"></i></div> Unpublish</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-trash-can"></i></div> Delete</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="detailtime">
                        <span class="timename">3 Dogs / Basic Clean-Up</span>
                        <div class="number_box"><div class="linenumber"></div>0/1</div>
                        <button class="btn shapeslide" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="timesitem bg_two" id="item2" draggable="true">
                      <div class="times">
                        <p class="white_p">8:30a - 9:15a</p>
                        <div class="dropdown dropend">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </button>
                          
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-square"></i></div> Select <div class="ctr">Ctrl + Shift + S</div></a></li>
                            <li class="dropdown drinside drbottom">
                              <a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-plus"></i></div> Asssign users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                              <ul class="dropdown-menu dropend group_dr">
                                <div class="group_user">
                                  <div class="list_agroup">
                                    <div class="searchuser">
                                      <input type="text" placeholder="Search users or smart groups" class="form-control">
                                      <i class="fas fa-search"></i>
                                    </div>
                                    <div class="all_usears">
                                      <span class="lightcolor">Qualified users</span>
                                        <div class="group_item">
                                          
                                          <input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for following text input">
                                          <div class="group_pr"><img src="{{asset ('/assets/img/provile.webp') }}"></div>
                                          <p data-bs-toggle="tooltip" data-bs-title="Chad Brooks">Chad Brooks</p>
                                          <div class="group_btn">
                                            <button type="button" class="btn">Available</button>
                                          </div>
                                          <div class="timegroup"><i class="far fa-clock"></i> 00:00</div>
                                        </div>
                                        <div class="group_item">
                                          
                                          <input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for following text input">
                                          <div class="group_pr"><img src="{{asset ('/assets/img/provile.webp') }}"></div>
                                          <p data-bs-toggle="tooltip" data-bs-title="Chad Brooks">Mike Jones</p>
                                          <div class="group_btn">
                                            <button type="button" class="btn">Available</button>
                                          </div>
                                          <div class="timegroup"><i class="far fa-clock"></i> 00:45</div>
                                        </div>
                                      <span class="lightcolor">Other users</span>
                                    </div>
                                  </div>
                                  <div class="save_btn"><button type="button" class="btn btnsave">Save</button></div>
                                </div>
                              </ul>
                            </li>
                            <li class="dropdown drinside">
                              <a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-graduation-cap"></i></div> Allocate users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                              <ul class="dropdown-menu dropend locate_job">
                                <div class="locate_inside">
                                  <div class="list_agroup">
                                    <div class="searchuser">
                                      <input type="text" placeholder="Search jobs" class="form-control">
                                      <i class="fas fa-search"></i>
                                    </div>
                                    <div class="joblocate">
                                      <div class="locate_item">
                                        <div class="circle cone"></div>
                                        <p>No Job</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle ctwo"></div>
                                        <p>1 Dog / Inital Clean-Up</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle cthree"></div>
                                        <p>2 Dogs / Inital Clean-Up</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle cfour"></div>
                                        <p>3 Dog / Inital Clean-Up</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle cfive"></div>
                                        <p>4 Dog/ Inital Clean-Up</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="save_btn"><button type="button" class="btn btnsave">Save</button></div>
                                </div>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-slash"></i></div> Duplicate <div class="check"><i class="fa-regular fa-circle-question"  data-bs-toggle="tooltip" data-bs-title="Lern More"></i></div></a></li>
                            <li class="dropdown drinside">
                              <a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-clone"></i></div> Multi duplicate <div class="check"><i class="fas fa-angle-right"></i></div></a>
                              <ul class="dropdown-menu dropend">
                                <div class="multi_duplicate">
                                  <input type="text" placeholder="0" class="form-control" value="2">
                                  <button type="button" class="btn btnmulti">Duplicate</button>
                                </div>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-slash"></i></div> Unassign</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-comments"></i></div> Start chat</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-square-minus"></i></div> Unpublish</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-trash-can"></i></div> Delete</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="detailtime">
                        <span class="timename">3 Dogs / Basic Clean-Up</span>
                        <button class="btn shapeslide" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                      </div>
                    </div>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- end item  --}}
            <div class="box_item">
              <div class="top_title day_week">
                <div class="day_details">
                  <div class="name_week">
                    <p>Mon 12/17</p>
                    <div class="dropdown dropend">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                      </button>
                      <ul class="dropdown-menu">
                        <li><span class="titlesmall">Weeks Actions</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="titlesmall">Template</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="detailinfo">
                    <i class="far fa-clock"></i>
                    <span>01:30</span>
                    <span class="number_profile"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg> 3</span>
                    <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                    <div class="box_pr downbox">
                      <div class="titlepr"><h4>Day totals</h4></div>
                      <div class="box_content">
                        <div class="content_item notop">
                          <p>Published shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Draft shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Assigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item noborder">
                          <p>Unassigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item infoheight">
                <div class="flex_info iconbtn">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#dailynote" aria-controls="dailynote"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item userheight">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item ">
                <div class="flex_info boxtime">
                  <div class="timesitem">
                    <div class="times">
                      <p>8:30a - 9:15a</p>
                      <div class="dropdown dropend">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-square"></i></div> Select <div class="ctr">Ctrl + Shift + S</div></a></li>
                          <li class="dropdown drinside drbottom">
                            <a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-plus"></i></div> Asssign users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend group_dr">
                              <div class="group_user">
                                <div class="list_agroup">
                                  <div class="searchuser">
                                    <input type="text" placeholder="Search users or smart groups" class="form-control">
                                    <i class="fas fa-search"></i>
                                  </div>
                                  <div class="all_usears">
                                    <span class="lightcolor">Qualified users</span>
                                      <div class="group_item">
                                        
                                        <input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <div class="group_pr"><img src="{{asset ('/assets/img/provile.webp') }}"></div>
                                        <p data-bs-toggle="tooltip" data-bs-title="Chad Brooks">Chad Brooks</p>
                                        <div class="group_btn">
                                          <button type="button" class="btn">Available</button>
                                        </div>
                                        <div class="timegroup"><i class="far fa-clock"></i> 00:00</div>
                                      </div>
                                      <div class="group_item">
                                        
                                        <input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <div class="group_pr"><img src="{{asset ('/assets/img/provile.webp') }}"></div>
                                        <p data-bs-toggle="tooltip" data-bs-title="Chad Brooks">Mike Jones</p>
                                        <div class="group_btn">
                                          <button type="button" class="btn">Available</button>
                                        </div>
                                        <div class="timegroup"><i class="far fa-clock"></i> 00:45</div>
                                      </div>
                                    <span class="lightcolor">Other users</span>
                                  </div>
                                </div>
                                <div class="save_btn"><button type="button" class="btn btnsave">Save</button></div>
                              </div>
                            </ul>
                          </li>
                          <li class="dropdown drinside">
                            <a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-graduation-cap"></i></div> Allocate users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend locate_job">
                              <div class="locate_inside">
                                <div class="list_agroup">
                                  <div class="searchuser">
                                    <input type="text" placeholder="Search jobs" class="form-control">
                                    <i class="fas fa-search"></i>
                                  </div>
                                  <div class="joblocate">
                                    <div class="locate_item">
                                      <div class="circle cone"></div>
                                      <p>No Job</p>
                                    </div>
                                    <div class="locate_item">
                                      <div class="circle ctwo"></div>
                                      <p>1 Dog / Inital Clean-Up</p>
                                    </div>
                                    <div class="locate_item">
                                      <div class="circle cthree"></div>
                                      <p>2 Dogs / Inital Clean-Up</p>
                                    </div>
                                    <div class="locate_item">
                                      <div class="circle cfour"></div>
                                      <p>3 Dog / Inital Clean-Up</p>
                                    </div>
                                    <div class="locate_item">
                                      <div class="circle cfive"></div>
                                      <p>4 Dog/ Inital Clean-Up</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="save_btn"><button type="button" class="btn btnsave">Save</button></div>
                              </div>
                            </ul>
                          </li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-slash"></i></div> Duplicate <div class="check"><i class="fa-regular fa-circle-question"  data-bs-toggle="tooltip" data-bs-title="Lern More"></i></div></a></li>
                          <li class="dropdown drinside">
                            <a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-clone"></i></div> Multi duplicate <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend">
                              <div class="multi_duplicate">
                                <input type="text" placeholder="0" class="form-control" value="2">
                                <button type="button" class="btn btnmulti">Duplicate</button>
                              </div>
                            </ul>
                          </li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-slash"></i></div> Unassign</a></li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-comments"></i></div> Start chat</a></li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-square-minus"></i></div> Unpublish</a></li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-trash-can"></i></div> Delete</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="detailtime">
                      <span class="timename">3 Dogs / Basic Clean-Up</span>
                      <button class="btn shapeslide" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- end item  --}}
            <div class="box_item">
              <div class="top_title day_week">
                <div class="day_details">
                  <div class="name_week">
                    <p>Mon 12/18</p>
                    <div class="dropdown dropend">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                      </button>
                      <ul class="dropdown-menu">
                        <li><span class="titlesmall">Weeks Actions</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="titlesmall">Template</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="detailinfo">
                    <i class="far fa-clock"></i>
                    <span>01:30</span>
                    <span class="number_profile"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg> 3</span>
                    <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                    <div class="box_pr downbox">
                      <div class="titlepr"><h4>Day totals</h4></div>
                      <div class="box_content">
                        <div class="content_item notop">
                          <p>Published shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Draft shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Assigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item noborder">
                          <p>Unassigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item infoheight">
                <div class="flex_info iconbtn">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#dailynote" aria-controls="dailynote"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item userheight">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- end item  --}}
            <div class="box_item">
              <div class="top_title day_week">
                <div class="day_details">
                  <div class="name_week">
                    <p>Mon 12/19</p>
                    <div class="dropdown dropend">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                      </button>
                      <ul class="dropdown-menu">
                        <li><span class="titlesmall">Weeks Actions</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="titlesmall">Template</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="detailinfo">
                    <i class="far fa-clock"></i>
                    <span>01:30</span>
                    <span class="number_profile"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg> 3</span>
                    <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                    <div class="box_pr downbox">
                      <div class="titlepr"><h4>Day totals</h4></div>
                      <div class="box_content">
                        <div class="content_item notop">
                          <p>Published shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Draft shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Assigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item noborder">
                          <p>Unassigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item infoheight">
                <div class="flex_info iconbtn">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#dailynote" aria-controls="dailynote"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item userheight">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- end item  --}}
            <div class="box_item">
              <div class="top_title day_week">
                <div class="day_details">
                  <div class="name_week">
                    <p>Mon 12/20</p>
                    <div class="dropdown dropend">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                      </button>
                      <ul class="dropdown-menu">
                        <li><span class="titlesmall">Weeks Actions</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="titlesmall">Template</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="detailinfo">
                    <i class="far fa-clock"></i>
                    <span>01:30</span>
                    <span class="number_profile"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg> 3</span>
                    <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                    <div class="box_pr downbox">
                      <div class="titlepr"><h4>Day totals</h4></div>
                      <div class="box_content">
                        <div class="content_item notop">
                          <p>Published shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Draft shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Assigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item noborder">
                          <p>Unassigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item infoheight">
                <div class="flex_info iconbtn">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#dailynote" aria-controls="dailynote"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item userheight">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- end item  --}}
            <div class="box_item">
              <div class="top_title day_week">
                <div class="day_details">
                  <div class="name_week">
                    <p>Mon 12/21</p>
                    <div class="dropdown dropend">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                      </button>
                      <ul class="dropdown-menu">
                        <li><span class="titlesmall">Weeks Actions</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="titlesmall">Template</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="detailinfo">
                    <i class="far fa-clock"></i>
                    <span>01:30</span>
                    <span class="number_profile"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg> 3</span>
                    <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                    <div class="box_pr downbox">
                      <div class="titlepr"><h4>Day totals</h4></div>
                      <div class="box_content">
                        <div class="content_item notop">
                          <p>Published shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Draft shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Assigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item noborder">
                          <p>Unassigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item infoheight">
                <div class="flex_info iconbtn">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#dailynote" aria-controls="dailynote"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item userheight">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- end item  --}}
            <div class="box_item">
              <div class="top_title day_week">
                <div class="day_details">
                  <div class="name_week">
                    <p>Mon 12/21</p>
                    <div class="dropdown dropend">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                      </button>
                      <ul class="dropdown-menu">
                        <li><span class="titlesmall">Weeks Actions</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="titlesmall">Template</span></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="detailinfo">
                    <i class="far fa-clock"></i>
                    <span>01:30</span>
                    <span class="number_profile"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg> 3</span>
                    <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                    <div class="box_pr downbox">
                      <div class="titlepr"><h4>Day totals</h4></div>
                      <div class="box_content">
                        <div class="content_item notop">
                          <p>Published shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Draft shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item">
                          <p>Assigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                        <div class="content_item noborder">
                          <p>Unassigned shifts</p>
                          <div class="item_number">
                            <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                              3</span>
                          </div>
                          <p class="item_number">
                            <i class="far fa-clock"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                          </p>
                          <p class="item_number">
                            <i class="far fa-user"></i>
                            <span data-bs-toggle="tooltip" data-bs-title="number of users">1</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item infoheight">
                <div class="flex_info iconbtn">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#dailynote" aria-controls="dailynote"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item userheight">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info iconbtn">
                  <div class="plus_info">
                    <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    <div class="dropdown dropend">
                      <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li class="drinside">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                          </button>
                          <ul class="dropdown-menu dropend">
                          <li class="select_template">
                              <div class="toptemplate">
                                <h5>Select Template</h5>
                                <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                              </div>
                              <div class="searchtemplate">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                              </div>
                              <div class="temp_list">
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                                <div class="item_temp">
                                  <p>8a - 12p</p>
                                  <span>Morning shift [Sample]</span>
                                </div>
                              </div>
                          </li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /week item -->
          <div class="day_area">
            <div class="box_item box_width">
              <div class="body_item infoheight">
                <div class="flex_info"><i class="far fa-file-alt"></i> <p>Daily info</p></div>
              </div>
              <div class="top_title">
                <div class="search_inside">
                  <input type="text" class="form-control" id="search" placeholder="Search users">
                  <button type="submit" class="btn search_btn"><i class="fas fa-search"></i></button>
                </div>
                <div class="sort_icon"><i class="fas fa-sort"></i></div>
              </div>
              <div class="body_item">
                <div class="flex_info"><p>Unassigned shifts</p> <i class="fas fa-magic"></i></div>
              </div>
              <div class="body_item">
                <div class="flex_info">
                  <div class="user_profile"><img src="{{asset ('/assets/img/provile.webp')}} "></div>
                  <div class="detail_user">
                    <p>Mike Jones</p>
                    <div class="detailinfo">
                      <i class="far fa-clock"></i>
                      <span>01:30</span>
                      <span class="number_profile">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                        3</span>
                        
                        <div class="box_pr">
                          <div class="titlepr"><h4>Mike's totals</h4></div>
                          <div class="box_content">
                            <div class="content_item">
                              <p>Published shifts</p>
                              <div class="item_number">
                                <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                                  <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                                  3</span>
                              </div>
                              <p class="item_number">
                                <i class="far fa-clock"></i>
                                <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                              </p>
                            </div>
                            
                            <div class="content_item bnone">
                              <p>Draft shifts</p>
                              <div class="item_number">
                                <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                                  <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                                  3</span>
                              </div>
                              <p class="item_number">
                                <i class="far fa-clock"></i>
                                <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                              </p>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="dropdown dropend userbtn">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      
                      <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                    </button>
                    <ul class="dropdown-menu">
                      <li><span class="titlesmall">Weeks Actions</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><span class="titlesmall">Template</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="body_item">
                <div class="flex_info">
                  <div class="user_profile"><img src="{{asset ('/assets/img/provile.webp')}}"></div>
                  <div class="detail_user">
                    <p>Mike Jones</p>
                    <div class="detailinfo">
                      <i class="far fa-clock"></i>
                      <span>01:30</span>
                      <span class="number_profile">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                        3</span>
                        <div class="box_pr">
                          <div class="titlepr"><h4>Mike's totals</h4></div>
                          <div class="box_content">
                            <div class="content_item">
                              <p>Published shifts</p>
                              <div class="item_number">
                                <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                                  <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                                  3</span>
                              </div>
                              <p class="item_number">
                                <i class="far fa-clock"></i>
                                <span data-bs-toggle="tooltip" data-bs-title="Total works hour">00:45</span>
                              </p>
                            </div>
                            
                            <div class="content_item bnone">
                              <p>Draft shifts</p>
                              <div class="item_number">
                                <span class="number_profile" data-bs-toggle="tooltip" data-bs-title="Number of shifts">
                                  <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ct-icon" data-testid="icon" style="min-width: 14px; min-height: 14px; color: var(--ct-gray-6);"><path d="M5.3 10.7998C4.8 10.7998 4.375 10.6248 4.025 10.2748C3.675 9.9248 3.5 9.4998 3.5 8.9998V5.6248C3.5 5.10814 3.675 4.6748 4.025 4.3248C4.375 3.9748 4.8 3.7998 5.3 3.7998H18.7C19.2 3.7998 19.625 3.9748 19.975 4.3248C20.325 4.6748 20.5 5.10814 20.5 5.6248V8.9998C20.5 9.4998 20.325 9.9248 19.975 10.2748C19.625 10.6248 19.2 10.7998 18.7 10.7998H5.3ZM5.3 9.2998H18.7C18.7667 9.2998 18.8333 9.27047 18.9 9.2118C18.9667 9.1538 19 9.08314 19 8.9998V5.6248C19 5.54147 18.9667 5.46647 18.9 5.3998C18.8333 5.33314 18.7667 5.2998 18.7 5.2998H5.3C5.23333 5.2998 5.16667 5.33314 5.1 5.3998C5.03333 5.46647 5 5.54147 5 5.6248V8.9998C5 9.08314 5.03333 9.1538 5.1 9.2118C5.16667 9.27047 5.23333 9.2998 5.3 9.2998ZM5.3 20.1998C4.8 20.1998 4.375 20.0248 4.025 19.6748C3.675 19.3248 3.5 18.8915 3.5 18.3748V14.9998C3.5 14.4998 3.675 14.0748 4.025 13.7248C4.375 13.3748 4.8 13.1998 5.3 13.1998H18.7C19.2 13.1998 19.625 13.3748 19.975 13.7248C20.325 14.0748 20.5 14.4998 20.5 14.9998V18.3748C20.5 18.8915 20.325 19.3248 19.975 19.6748C19.625 20.0248 19.2 20.1998 18.7 20.1998H5.3ZM5.3 18.6998H18.7C18.7667 18.6998 18.8333 18.6665 18.9 18.5998C18.9667 18.5331 19 18.4581 19 18.3748V14.9998C19 14.9165 18.9667 14.8455 18.9 14.7868C18.8333 14.7288 18.7667 14.6998 18.7 14.6998H5.3C5.23333 14.6998 5.16667 14.7288 5.1 14.7868C5.03333 14.8455 5 14.9165 5 14.9998V18.3748C5 18.4581 5.03333 18.5331 5.1 18.5998C5.16667 18.6665 5.23333 18.6998 5.3 18.6998ZM5 5.2998V9.2998V5.2998ZM5 14.6998V18.6998V14.6998Z" fill="currentColor"></path></svg>
                                  3</span>
                              </div>
                              <p class="item_number">
                                <i class="far fa-clock"></i>
                                <span data-bs-toggle="tooltip" data-bs-title="Total works hour">--</span>
                              </p>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="dropdown dropend userbtn">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      
                      <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                    </button>
                    <ul class="dropdown-menu">
                      <li><span class="titlesmall">Weeks Actions</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><span class="titlesmall">Template</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            {{-- end item  --}}
            <div class="date_items">
              
              <div class="body_item infoheight fullwidth">
                <div class="flex_info iconbtn dailyinfobtn">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#dailynote" aria-controls="dailynote"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="dayitems">
                <div class="box_item darkbg">
                  <div class="top_title day_week">
                    <p class="time_title">12am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                <div class="box_item darkbg">
                  <div class="top_title day_week">
                    <p class="time_title">1am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                <div class="box_item darkbg">
                  <div class="top_title day_week">
                    <p class="time_title">2am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                <div class="box_item darkbg">
                  <div class="top_title day_week">
                    <p class="time_title">3am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">4am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">5am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn boxtime">
                      <div class="boxinfo">
                        <div class="timesitem">
                          <div class="times">
                            <p>8:30a - 9:15a</p>
                            <div class="dropdown dropend">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                              </button>
                              
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-square"></i></div> Select <div class="ctr">Ctrl + Shift + S</div></a></li>
                            <li class="dropdown drinside drbottom">
                              <a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-plus"></i></div> Asssign users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                              <ul class="dropdown-menu dropend group_dr">
                                <div class="group_user">
                                  <div class="list_agroup">
                                    <div class="searchuser">
                                      <input type="text" placeholder="Search users or smart groups" class="form-control">
                                      <i class="fas fa-search"></i>
                                    </div>
                                    <div class="all_usears">
                                      <span class="lightcolor">Qualified users</span>
                                        <div class="group_item">
                                          
                                          <input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for following text input">
                                          <div class="group_pr"><img src="http://127.0.0.1:8000/assets/img/provile.webp"></div>
                                          <p data-bs-toggle="tooltip" data-bs-title="Chad Brooks">Chad Brooks</p>
                                          <div class="group_btn">
                                            <button type="button" class="btn">Available</button>
                                          </div>
                                          <div class="timegroup"><i class="far fa-clock"></i> 00:00</div>
                                        </div>
                                        <div class="group_item">
                                          
                                          <input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for following text input">
                                          <div class="group_pr"><img src="http://127.0.0.1:8000/assets/img/provile.webp"></div>
                                          <p data-bs-toggle="tooltip" data-bs-title="Chad Brooks">Mike Jones</p>
                                          <div class="group_btn">
                                            <button type="button" class="btn">Available</button>
                                          </div>
                                          <div class="timegroup"><i class="far fa-clock"></i> 00:45</div>
                                        </div>
                                      <span class="lightcolor">Other users</span>
                                    </div>
                                  </div>
                                  <div class="save_btn"><button type="button" class="btn btnsave">Save</button></div>
                                </div>
                              </ul>
                            </li>
                            <li class="dropdown drinside">
                              <a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-graduation-cap"></i></div> Allocate users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                              <ul class="dropdown-menu dropend locate_job">
                                <div class="locate_inside">
                                  <div class="list_agroup">
                                    <div class="searchuser">
                                      <input type="text" placeholder="Search jobs" class="form-control">
                                      <i class="fas fa-search"></i>
                                    </div>
                                    <div class="joblocate">
                                      <div class="locate_item">
                                        <div class="circle cone"></div>
                                        <p>No Job</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle ctwo"></div>
                                        <p>1 Dog / Inital Clean-Up</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle cthree"></div>
                                        <p>2 Dogs / Inital Clean-Up</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle cfour"></div>
                                        <p>3 Dog / Inital Clean-Up</p>
                                      </div>
                                      <div class="locate_item">
                                        <div class="circle cfive"></div>
                                        <p>4 Dog/ Inital Clean-Up</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="save_btn"><button type="button" class="btn btnsave">Save</button></div>
                                </div>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-slash"></i></div> Duplicate <div class="check"><i class="fa-regular fa-circle-question" data-bs-toggle="tooltip" data-bs-title="Lern More"></i></div></a></li>
                            <li class="dropdown drinside">
                              <a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-clone"></i></div> Multi duplicate <div class="check"><i class="fas fa-angle-right"></i></div></a>
                              <ul class="dropdown-menu dropend">
                                <div class="multi_duplicate">
                                  <input type="text" placeholder="0" class="form-control" value="2">
                                  <button type="button" class="btn btnmulti">Duplicate</button>
                                </div>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-solid fa-user-slash"></i></div> Unassign</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-comments"></i></div> Start chat</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-square-minus"></i></div> Unpublish</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fa-regular fa-trash-can"></i></div> Delete</a></li>
                          </ul>
                        </div>
                        </div>
                          <div class="detailtime">
                            <span class="timename">3 Dogs / Basic Clean-Up</span>
                            <button class="btn shapeslide" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                          </div>
                        </div>
                        <div class="event-box">
                          <div class="event-box-content">
                            <h4>Sam cook</h4>
                            <div class="box_number">
                              <div class="box_number_item"></div>
                              <p>0/1</p>
                            </div>
                            <ul> 
                              <li><i class="fas fa-calendar-alt"></i> 14 May 2024</li>
                              <li><i class="fas fa-clock"></i> 8a - 8:30a</li>
                              <li><i class="fa-solid fa-briefcase"></i> 3 Dogs / Basic Clean-Up</li>
                              <li><i class="fa-solid fa-location-dot"></i> 4200 Conroy Road, Orlando, FL, USA</li>
                              <li><i class="fa-solid fa-user"></i> <img src="http://127.0.0.1:8000/assets/img/provile.webp"> Mike Jones</li>
                          </ul></div>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">6am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">7am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">8am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">9am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">10am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">11am</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">12pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">1pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">2pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">3pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">4pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">5pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">6pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">7pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">8pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">9pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">10pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
                {{-- end item  --}}
                <div class="box_item">
                  <div class="top_title day_week">
                    <p class="time_title">11pm</p>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="body_item">
                    <div class="flex_info iconbtn">
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="plus_info">
                        <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                        <div class="dropdown dropend">
                          <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li class="drinside">
                              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                              </button>
                              <ul class="dropdown-menu dropend">
                              <li class="select_template">
                                  <div class="toptemplate">
                                    <h5>Select Template</h5>
                                    <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                                  <div class="searchtemplate">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="temp_list">
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                    <div class="item_temp">
                                      <p>8a - 12p</p>
                                      <span>Morning shift [Sample]</span>
                                    </div>
                                  </div>
                              </li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                            <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end item  --}}
              </div>
            </div>
          </div>
        {{-- end item  --}}
        
        <div class="app-overlay"></div>
      </div>
      <!-- Event Item -->
      <div class="event-box">
        <div class="event-box-content">
          <h4>Harold Smith</h4>
          <ul> 
            <li><i class="fas fa-calendar-alt"></i> 14 May 2024</li>
            <li><i class="fas fa-clock"></i> 8a - 8:30a</li>
            <li><i class="fa-solid fa-briefcase"></i> 3 Dogs / Basic Clean-Up</li>
            <li><i class="fa-solid fa-location-dot"></i> 4200 Conroy Road, Orlando, FL, USA</li>
            <li><i class="fa-solid fa-user"></i> <img src="{{asset('assets/img/provile.webp')}}"> Mike Jones</li>
        </div>
      </div>
      <!-- /Event Item -->
      <div class="useradd">
        <div class="dropdown">
          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Add more users
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Add admins</a></li>
            <li><a class="dropdown-item" href="#">Add users</a></li>
          </ul>
        </div>
      </div>
      {{-- end main boxes  --}}
  </div>
    <div class="app-calendar-events-filter text-heading" style="display: none;">
          <div class="form-check form-check-danger mb-5 ms-2">
            <input class="form-check-input input-filter" type="checkbox" id="select-personal" data-value="personal" checked>
            <label class="form-check-label" for="select-personal">Personal</label>
          </div>
          <div class="form-check mb-5 ms-2">
            <input class="form-check-input input-filter" type="checkbox" id="select-business" data-value="business" checked>
            <label class="form-check-label" for="select-business">Business</label>
          </div>
          <div class="form-check form-check-warning mb-5 ms-2">
            <input class="form-check-input input-filter" type="checkbox" id="select-family" data-value="family" checked>
            <label class="form-check-label" for="select-family">Family</label>
          </div>
          <div class="form-check form-check-success mb-5 ms-2">
            <input class="form-check-input input-filter" type="checkbox" id="select-holiday" data-value="holiday" checked>
            <label class="form-check-label" for="select-holiday">Holiday</label>
          </div>
          <div class="form-check form-check-info ms-2">
            <input class="form-check-input input-filter" type="checkbox" id="select-etc" data-value="etc" checked>
            <label class="form-check-label" for="select-etc">ETC</label>
          </div>
        </div>
    <!-- /Calendar area -->

    <!-- Calendar & Modal -->
    <div class="col app-calendar-content">
      <div class="card shadow-none border-0">
        <div class="card-body pb-0">
          <!-- FullCalendar -->
          <div id="calendar"></div>
        </div>
      </div>
      <!-- FullCalendar Offcanvas -->
      <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addEventSidebar" aria-labelledby="addEventSidebarLabel">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Event</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <form class="event-form pt-0" id="eventForm" onsubmit="return false">
            <div class="mb-6">
              <label class="form-label" for="eventTitle">Title</label>
              <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Event Title" />
            </div>
            <div class="mb-6">
              <label class="form-label" for="eventLabel">Label</label>
              <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                <option data-label="primary" value="Business" selected>Business</option>
                <option data-label="danger" value="Personal">Personal</option>
                <option data-label="warning" value="Family">Family</option>
                <option data-label="success" value="Holiday">Holiday</option>
                <option data-label="info" value="ETC">ETC</option>
              </select>
            </div>
            <div class="mb-6">
              <label class="form-label" for="eventStartDate">Start Date</label>
              <input type="text" class="form-control" id="eventStartDate" name="eventStartDate" placeholder="Start Date" />
            </div>
            <div class="mb-6">
              <label class="form-label" for="eventEndDate">End Date</label>
              <input type="text" class="form-control" id="eventEndDate" name="eventEndDate" placeholder="End Date" />
            </div>
            <div class="mb-6">
              <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input allDay-switch" id="allDaySwitch" />
                <label class="form-check-label" for="allDaySwitch">All Day</label>
              </div>
            </div>
            <div class="mb-6">
              <label class="form-label" for="eventURL">Event URL</label>
              <input type="url" class="form-control" id="eventURL" name="eventURL" placeholder="https://www.google.com" />
            </div>
            <div class="mb-4 select2-primary">
              <label class="form-label" for="eventGuests">Add Guests</label>
              <select class="select2 select-event-guests form-select" id="eventGuests" name="eventGuests" multiple>
                <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
              </select>
            </div>
            <div class="mb-6">
              <label class="form-label" for="eventLocation">Location</label>
              <input type="text" class="form-control" id="eventLocation" name="eventLocation" placeholder="Enter Location" />
            </div>
            <div class="mb-6">
              <label class="form-label" for="eventDescription">Description</label>
              <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
            </div>
            <div class="d-flex justify-content-sm-between justify-content-start mt-6 gap-2">
              <div class="d-flex">
                <button type="submit" id="addEventBtn" class="btn btn-primary btn-add-event me-4">Add</button>
                <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1" data-bs-dismiss="offcanvas">Cancel</button>
              </div>
              <button class="btn btn-label-danger btn-delete-event d-none">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Calendar & Modal -->
    <!-- data-event-id="1" -->



  </div>
</div>
@endsection
