@include('backend.trainer.layouts.navbar')
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('backend.trainer.layouts.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('backend.trainer.layouts.header');
      <!--  Header End -->
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div>
                    <h1>Edit Workout</h1>
                </div> 

                <div>
                    <button class="btn btn-danger"  data-toggle="modal" data-target="#deleteModal">Delete</button>
                </div>
            </div>
        </div> 
       
        @foreach($workouts as $workout)
        @foreach( $workout->days as $day)
            <div class="box">
                <div class="row">
                    <h3>{{$day}}</h3>
                </div>
            </div>
        @endforeach
    @endforeach
    
    
    

        
        
    </div>
    
   

  @include('backend.trainer.layouts.footer')
</body>

</html>