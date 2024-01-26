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
      @include('backend.trainer.layouts.header')
      <!--  Header End -->
      <div class="container-fluid">
        <div>
            <h1>My profile</h1>
        </div>

        <div>
            <form class="form-control p-4" action="{{ route('create.profile-update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="trainer_id" value="{{ $trainer->id }}">

                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('images/TrainerImage/' . $trainer->picture) }}" alt="" width="200px" height="200px">
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
                        <label for="trainer_number">Trainer Number</label>
                        <input type="text" class="form-control @error('trainer_number') is-invalid @enderror" value="{{ $trainer->trainer_number }}" name="trainer_number" readonly>
                        @error('trainer_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $trainer->name }}" name="name">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control @error('contact') is-invalid @enderror" value="{{ $trainer->contact }}" name="contact">
                        @error('contact')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <label for="address">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $trainer->address }}" name="address">
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="body_weight">Body weight</label>
                        <input type="text" class="form-control @error('body_weight') is-invalid @enderror" value="{{ $trainer->body_weight }}" name="body_weight">
                        @error('body_weight')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="height">Height</label>
                        <input type="text" class="form-control @error('height') is-invalid @enderror" value="{{ $trainer->height }}" name="height">
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
            <form action="{{ route('create.profile-reset-password') }}" class="form-control p-4" method="POST">
                @csrf
                <input type="hidden" name="trainer_id" value="{{$trainer->id}}">
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
  @include('backend.trainer.layouts.footer')
</body>

</html>