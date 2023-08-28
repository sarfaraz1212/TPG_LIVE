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
        <!--  Row 1 -->
  
            <h1>Add package</h1>
            <form action="{{ route('create.package') }}" method="post" class="mt-3">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <label for="packagename">Package Name</label>
                        <input id="packagename" type="text" class="form-control @error('packagename') is-invalid @enderror" name="packagename" required>
                        @error('packagename')
                          <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
    
                    <div class="col-4">
                        <label for="packageduration">Package Duration</label>
                        <select name="packageduration" id="packageduration" class="form-control @error('packageduration') is-invalid @enderror" required >
                            <option value="1">1 month</option>
                            <option value="3">3 months</option>
                            <option value="6">6 months</option>
                            <option value="12">12 months</option>
                        </select>
                        @error('packageduration')
                          <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="packageprice">Package Price</label>
                        <input id="packageprice" type="text" class="form-control @error('packageprice') is-invalid @enderror" name="packageprice" required>
                        @error('packageprice')
                          <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="row mt-3 d-flex justify-content-end">
                    <div class="col-3">
                       <button type="submit" class="form-control btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
            

      </div>
    </div>
  </div>
  @include('backend.admin.layouts.footer');
</body>

</html>