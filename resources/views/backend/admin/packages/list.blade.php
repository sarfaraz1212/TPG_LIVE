@include('backend.admin.layouts.navbar');

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('backend.admin.layouts.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('backend.admin.layouts.header');
      <!--  Header End -->
      

      <div class="container-fluid">
        <h1>Packages</h1>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Duration</th>
              <th scope="col">Fee</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- For non verified-->
            @foreach ($packages as $package)
            <tr>
              <td>{{ $package->package_name }} </td>
              <td>{{ $package->package_duration }} {{ $package->package_duration == 1 ? 'month' : 'months' }}</td>
              <td>{{ $package->package_price }}</td>
              <td>
                <div class="d-flex">
                    <button class="btn btn-success">Edit</button>
                    <button class="ms-1 btn btn-danger">Delete</button>
                </div>
              </td>
            </tr>   
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!--  Main wrapper End -->
    <!--  Scripts -->
    @include('backend.admin.layouts.footer');
  </div>
  <!--  Body Wrapper End -->
</body>
</html>
