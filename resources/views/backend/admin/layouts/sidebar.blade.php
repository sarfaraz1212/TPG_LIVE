<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./index.html" class="text-nowrap logo-img">
            
          <img src="{{ asset('backend/admin/images/logos/dark-logo.svg')}}" width="180" alt="" />
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
            <span class="hide-menu">Admin Dashboard</span>
          </li>

        <!--   <li class="nav-item dropdown ms-3 mt-3">
            <a class="" style="color:black;" id="clientsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-layout-dashboard me-2" style="font-size:15px;"></i>
                <span class="hide-menu" style="font-size:15px;">Dashboard</span>
            </a>
    
          </li> -->

          <div class="accordion" id="clientsAccordion">
            <div class="accordion-item" style="border-style: none;">
                <h2 class="accordion-header" id="clientsHeading">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addClientCollapse" aria-expanded="false" aria-controls="addClientCollapse">
                        <i class="ti ti-layout-dashboard me-2" style="font-size:15px; color: black;"></i>
                        <span class="hide-menu" style="font-size:15px; color: black;">Clients</span>
                    </button>
                </h2>
                <div id="addClientCollapse" class="accordion-collapse collapse" aria-labelledby="clientsHeading" data-bs-parent="#clientsAccordion">
                    <div class="accordion-body">
                        <a class="dropdown-item p-1" href="{{ route('view.addclient') }}" style="color:black;">Add</a>
                        <a class="dropdown-item p-1" href="{{ route('view.clients') }}" style="color:black;">List</a>
                        <a class="dropdown-item p-1" href="{{ route('view.non_verfified_clients') }}" style="color:black;">Not verified</a>
                        <!-- Add more accordion items if needed -->
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="accordion  " id="trainersAccordion">
            <div class="accordion-item" style="border-style: none;">
                <h2 class="accordion-header" id="trainersHeading">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#viewTrainersCollapse" aria-expanded="false" aria-controls="viewTrainersCollapse">
                        <i class="ti ti-layout-dashboard me-2" style="font-size:15px; color: black;"></i>
                        <span class="hide-menu" style="font-size:15px; color: black;">Trainers</span>
                    </button>
                </h2>
                <div id="viewTrainersCollapse" class="accordion-collapse collapse" aria-labelledby="trainersHeading" data-bs-parent="#trainersAccordion">
                    <div class="accordion-body">
                        <a class="dropdown-item p-1" href="{{ route('view.addtrainer') }}" " style="color:black;" >Add</a>
                        <a class="dropdown-item p-1" href="{{ route('view.trainers_list') }}" " style="color:black;" >List</a>
                        <a class="dropdown-item p-1" href="{{ route('view.non_verfified_trainers') }}" " style="color:black;" >Not verified</a>
                        <!-- Add more accordion items if needed -->
                    </div>
                </div>
            </div>
        </div>
        

        <div class="accordion  " id="packagesAccordion">
          <div class="accordion-item" style="border-style: none;">
              <h2 class="accordion-header" id="packagesHeading">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#viewPackagesCollapse" aria-expanded="false" aria-controls="viewPackagesCollapse">
                      <i class="ti ti-layout-dashboard me-2" style="font-size:15px; color: black;"></i>
                      <span class="hide-menu" style="font-size:15px; color: black;">Packages</span>
                  </button>
              </h2>
              <div id="viewPackagesCollapse" class="accordion-collapse collapse" aria-labelledby="packagesHeading" data-bs-parent="#packagesAccordion">
                  <div class="accordion-body">
                      <a class="dropdown-item" href="{{ route('view.packages') }}">Add</a>
                      <a class="dropdown-item" href="{{ route('view.packagelist') }}">List</a>
                      <!-- Add more accordion items if needed -->
                  </div>
              </div>
          </div>
        </div>
      
     

         


          <li class="nav-small-cap">
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