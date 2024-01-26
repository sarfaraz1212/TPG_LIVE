@include('backend.client.layouts.navbar')
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <style>
        
    </style>
    <!-- Sidebar Start -->
    @include('backend.client.layouts.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('backend.client.layouts.header');
      <!--  Header End -->

        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div>
                    <h1>My Workout</h1>
                </div>
                <div> 
                    @if(isset($trainer)) 
                        <h3>Added by:{{$trainer}}</h3> 
                    @endif
                </div>

            </div>

        
            <div class="card shadow-lg" style="width: 100%;">
                <div class="card-body">
                    <div class="box">
                        @foreach($workouts as $i => $workout)  
                            <h3 class="font-weight-bold">{{$workout->day}}</h3>
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Exercise Name</th>
                                        <th scope="col">Sets</th>
                                        <th scope="col">Reps</th>
                                        <th scope="col">Instructions</th>
                                        <th scope="col">reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $workout->exercise_name as $key => $exercise )
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$workout->exercise_name[$key]}}</td>
                                            <td>{{$workout->sets[$key]}}</td>
                                            <td>{{$workout->reps[$key]}}</td>
                                            <td>{{$workout->instructions[$key]}}</td>
                                            <td><a href="{{$workout->reference[$key]}}" target="_blank">Click here!</a></td>  
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">Request Change</button>
                    </div>
                    
                </div>
            </div>
        </div>
  @include('backend.client.layouts.footer')
</body>

</html>