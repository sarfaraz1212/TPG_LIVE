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
        <h1>Clients (not verified)</h1>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Contact</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- For non verified-->
            @foreach ($clients as $client)
            <tr>
              <td>{{ $client->name }}</td>
              <td>{{ $client->email }}</td>
              <td>{{ $client->contact }}</td>
              <td>
                <div class="d-flex">
                  <div>
                    <form action="{{ route('create.client_re_verify') }}" method="post">
                      @csrf
                      <input type="hidden" name="email" value="{{$client->email}}">
                      <input type="hidden" name="name" value="{{$client->name}}">
                      <button type="submit" class="btn btn-success">Verify</button>
                    </form>
                    
                  </div>

                  <div>
                    <a href="#" id="dltbtn" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger ms-1">Delete</a>
                </div>
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
