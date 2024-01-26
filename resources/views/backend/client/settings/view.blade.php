@include('backend.client.layouts.navbar')
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('backend.client.layouts.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('backend.client.layouts.header');
      <!--  Header End -->
      <div class="container-fluid">
        <div>
            <h1>My profile</h1>
        </div>

        <div>
            <form class="form-control p-4" action="{{ route('create.client-profile-update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="client_id" value="{{$client->id}}">

                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('images/ClientImages/' . $client->profile) }}" alt="" width="200px" height="200px">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <label for="profile">Profile</label>
                        <input type="file" class="form-control @error('profile') is-invalid @enderror" name="profile">
                        @error('profile')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">

                    <div class="col-4">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$client->name}}" name="name">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control @error('contact') is-invalid @enderror" value="{{$client->contact}}" name="contact">
                        @error('contact')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="address">Email</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{$client->email}}" name="email" readonly>
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
 
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <label for="address">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{$client->address}}" name="address" readonly>
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="body_weight">Body weight</label>
                        <input type="text" class="form-control @error('body_weight') is-invalid @enderror" value="{{$client->bodyweight}}" name="bodyweight">
                        @error('body_weight')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="height">Height</label>
                        <input type="text" class="form-control @error('height') is-invalid @enderror" value="{{$client->height}}" name="height">
                        @error('height')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row d-flex justify-content-end mt-3">
                    <div class="col-3 d-flex justify-content-end">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>


        <div >
            <h1 class="mt-4">Reset password</h1>
            <form action="{{ route('create.client-password-update') }}" class="form-control p-4" method="POST">
                @csrf
                <input type="hidden" name="client_id" value="{{$client->id}}">
                <div class="row">
                    <div class="col-4">
                        <label for="">Current Password</label>
                        <input type="password" class="form-control @error('currentpassword') is-invalid @enderror" name="currentpassword" id="">
                        @error('currentpassword')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="">New Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="">
                        @error('password')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for=""> Confirm new Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="">
                        @error('password_confirmation')
                            <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="row d-flex justify-content-end mt-3">
                    <div class="col-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>

            </form>
        </div>
      <div>   
    </div>
  </div>
  @include('backend.client.layouts.footer')
</body>

</html>