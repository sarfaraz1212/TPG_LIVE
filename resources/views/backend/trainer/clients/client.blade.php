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
        <!--  Row 1 -->

    
        
        <div class="box shadow ">
            <div class="card2 card mb-3" style="max-width: 100%;">
                <div class="row g-0 ali">
                <div class="col-sm-4 col-5">
                    <img src="{{ asset('/images/ClientImages/user.jpg') }}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-sm-8 col-7 ">
                    <div class="row mt-3 ">
                        <h1 class="text-center">{{$client->name}}</h1>
                    </div>
                    <div class="row mt-4 ms-2" style="width:750px">
                        <div class="col-6">
                            <div class="text-center">
                                <span style="font-size:20px;">
                                    Height: {{$client->height}}
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <span style="font-size:20px;">
                                    Bodyweight: {{$client->bodyweight}}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 ms-2" style="width:750px">
                        <div class="col-6">
                            <div class="text-center">
                                <span style="font-size:20px;">
                                    <p>Gender: {{ $client->gender }}</p>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <span style="font-size:20px;">
                                    Goal: {{$client->goals}}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 ms-2" style="width:750px">
                        <div class="col-6">
                            <div class="text-center">
                                <span style="font-size:20px;">
                                    <p>Package: {{ $client->package }}</p>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <span style="font-size:20px;">
                                    Duration: {{$client->package_duration}}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 ms-2" style="width:750px">
                        <div class="col-6">
                            <div class="text-center">
                                <span style="font-size:20px;">
                                    <p>Email: {{ $client->email }}</p>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <span style="font-size:20px;">
                                    Contact: {{$client->contact}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <a href="{{ route('create.diet',['id' => $client->id]) }}"><button class="btn btn-primary btn-block w-100">Add Diet</button></a>
            </div>

            <div class="col-3">
                <button class="btn btn-primary btn-block w-100">Add Workout</button>
            </div>

            <div class="col-3">
                <button class="btn btn-dark btn-block w-100">Progress Tracker</button>
            </div>

            <div class="col-3">
                <button class="btn btn-dark btn-block w-100">Report</button>
            </div>
        </div>
       
  @include('backend.trainer.layouts.footer')
</body>

</html>