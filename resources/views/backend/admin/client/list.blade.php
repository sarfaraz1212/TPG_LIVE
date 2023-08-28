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
        <div class="d-flex justify-content-between">
          <div>
            <h1>Clients</h1>
          </div>

          <div>
            <a class="btn btn-primary" href="{{ route('view.addclient') }}">Add Client</a>
          </div>
       
        </div>
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
            <!-- V means verified-->
            @foreach ($Vclients as $Vclient)
            <tr>
              <td>{{ $Vclient->name }}</td>
              <td>{{ $Vclient->email }}</td>
              <td>{{ $Vclient->contact }}</td>
              <td>
                <div class="d-flex">
                  <div>
                    <a href="{{ route('view.edit-client',['id'=>$Vclient->id]) }}" class="btn btn-success">Edit</a>
                  </div>

                  <div>
                    <a href="#" data-toggle="modal" data-target="#deleteModal{{$Vclient->id}}"  class="btn btn-danger ms-1 delete-btn">Delete</a>
                </div>
                </div>  
              </td>
            <tr>

              <div class="modal fade" id="deleteModal{{$Vclient->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" class="modalss" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the trainer <span id="trainerName"></span>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button id="deleteConfirmBtn" type="button" class="btn btn-danger"><a style="text-decoration:none;color:white;" href="{{route('view.delete-trainer',['id'=>$Vclient->id])}}">Delete</a></button>
                        </div>
                    </div>
                </div>
            </div>

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
