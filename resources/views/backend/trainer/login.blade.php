<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The physique gym</title>
  <link rel="stylesheet" href="{{asset('backend/trainer/css/styles.min.css')}}" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img">  
                    <h2 class=" text-center b-5" style="font-weight: 700;">The Physique Gym</h2>
                </a>
                <p class="text-center">Trainer Dashboard</p>

                @if(session('success'))
                  <div>
                    <div class="alert alert-success" role="alert">
                      <span style="color:black;">{{ session('success') }}</span>
                    </div>
                  </div>
                @endif

                @if(session('error'))
                  <div>
                    <div class="alert alert-danger" role="alert">
                      <span style="color:black;">{{ session('error') }}!</span>
                    </div>
                  </div>
                @endif


                <form action="{{route('create.trainer-login')}}" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" name ="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="#" id="forgotPasswordLink">Forgot Password ?</a>

                  </div>
                  <button type="submit" class="btn btn-danger w-100 py-8 fs-4 mb-4 rounded-2">Sign in</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Added 'modal-dialog-centered' class here -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Add your form or content for password recovery here -->
          <form id="password-reset-form" method="post">
            @csrf
            <!-- Form fields go here -->
            <!-- For example, an input for the user's email address -->
            <div class="row">
                <div id="message" class="alert alert-danger" style="display:none;"></div>
            </div>


            <div class="mb-3 mt-2">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="forgot-email" aria-describedby="emailHelp" value="" required>
            </div>
        
           
            <button type="submit mt-2" class="btn btn-primary" id="SendResetPasswordLink">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>


</body>


<script>
$(document).ready(function() {
  $('#forgotPasswordLink').click(function(e) {
    e.preventDefault();
    $('#forgotPasswordModal').modal('show');
  });
});

$(document).ready(function() {
  $('#password-reset-form').on('submit', function(e) {
    e.preventDefault();
    $('error').text('');

    const email = $('#forgot-email').val();

    $.ajax({
      url: "{{ route('create.link') }}", // Added double quotes around the URL
      type: "POST",
      data: {
        email: email,
      }, headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },// Added a comma here to separate data and success function
      success: function(response) {
        const message = $('#message');

        if (response.status == 'error') 
        {
            message.removeClass('alert-success').addClass('alert-danger').text(response.message).show();
        } 
        else if (response.status == 'success') 
        {
            message.removeClass('alert-danger').addClass('alert-success').text(response.message).show();
        } 
        else 
        {
            message.hide(); 
        }
        
      } 
    });

  });
});


</script>


</html>