<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./index.html" class="text-nowrap logo-img">  
          <h4 class="mt-5 mb-5" style="font-weight: 700;">The Physique Gym</h4>
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Trainer Dashboard</span>
          </li>

        <!--   <li class="nav-item dropdown ms-3 mt-3">
            <a class="" style="color:black;" id="clientsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-layout-dashboard me-2" style="font-size:15px;"></i>
                <span class="hide-menu" style="font-size:15px;">Dashboard</span>
            </a>
    
          </li> -->

          <div class="accordion" id="clientsAccordion1">
              <div class="accordion-item" style="border-style: none;">
                  <h2 class="accordion-header" id="clientsHeading1">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addClientCollapse" aria-expanded="false" aria-controls="addClientCollapse">
                          <i class="ti ti-layout-dashboard me-2" style="font-size:15px; color: black;"></i>
                          <span class="hide-menu" style="font-size:15px; color: black;">Clients</span>
                      </button>
                  </h2>
                  <div id="addClientCollapse" class="accordion-collapse collapse" aria-labelledby="clientsHeading1" data-bs-parent="#clientsAccordion1">
                      <div class="accordion-body">
                          <a class="dropdown-item p-1" href="{{ route('view.my-clients') }}" style="color:black;">My Clients</a>
                          <!-- Add more accordion items if needed -->
                      </div>
                  </div>
              </div>
          </div>

          <div class="accordion" id="clientsAccordion2">
              <div class="accordion-item" style="border-style: none;">
                  <h2 class an="accordion-header" id="clientsHeading2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#settingsCollapse" aria-expanded="false" aria-controls="settingsCollapse">
                          <i class="ti ti-layout-dashboard me-2" style="font-size:15px; color: black;"></i>
                          <span class="hide-menu" style="font-size:15px; color: black;">Settings</span>
                      </button>
                  </h2>
                  <div id="settingsCollapse" class="accordion-collapse collapse" aria-labelledby="clientsHeading2" data-bs-parent="#clientsAccordion2">
                      <div class="accordion-body">
                          <a class="dropdown-item p-1" href="{{ route('view.my-profile') }}" style="color:black;">My profile</a>
                          <!-- Add more accordion items if needed -->
                      </div>
                  </div>
              </div>
          </div>

          <a href="{{ route('view.timeslots') }}" class="ms-3" style="font-size: 15px; color: black; text-decoration: none;">
              <i class="ti ti-layout-dashboard me-2" style="font-size: 15px; color: black;"></i>
              <span class="hide-menu" style="font-size: 15px; color: black;">Time slots</span>
          </a>



        
          <li class="nav-small-cap mt-5">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">UI COMPONENTS</span>
          </li>
          
         
        </ul>

      
        <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
          <div class="d-flex">
            <div class="unlimited-access-title me-3">
              <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
              <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
            </div>
        
          </div>
        </div>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>