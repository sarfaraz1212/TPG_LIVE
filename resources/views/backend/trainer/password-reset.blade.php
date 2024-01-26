<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{asset('backend/trainer/css/styles.min.css')}}" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="box d-flex align-items-center " style="height:100vh;">
            <form action="{{ route('create.reset-password') }}" method="POST"class="form-control p-5">
                @csrf
          
                <input type="hidden" value="{{$token}}" name="token">
                <div class="row">
                    <label for="">New password</label>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="">
                    @error('password')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="row mt-2">
                    <label for="">Confirm New password</label>
                    <input class="form-control @error('cpassword') is-invalid @enderror" type="password" name="cpassword" id="">
                    @error('cpassword')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="row mt-4">
                    <button class="form-control btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>