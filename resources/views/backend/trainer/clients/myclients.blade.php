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
        <div class="d-flex">
        @foreach ($clients as $key=>$client)
        
            <div class="d-flex">
                <div class="card @if(!$key == '0') ms-3 @endif" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('/images/ClientImages/user.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{$client->name}}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{ route('view.client',['id' => $client->id]) }}" class="btn btn-primary">View</a>
                    </div>
                </div>
            @endforeach
        </div>
      </div>
  @include('backend.trainer.layouts.footer')
</body>

</html>