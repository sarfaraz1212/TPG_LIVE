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
            <h1>Add Client</h1>
          </div>

          <div>
            <a class="btn btn-primary" href="{{ route('view.clients') }}">View Clients</a>
          </div>
       
        </div>
        <form class="form-control mt-2" action="{{route('create.addclient' )}}" id="addclientform" method="POST">
          @csrf
            <div class="row">                        
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="Name" class="form-label">Name:</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"  placeholder="" name="name" value="{{old('name')}}">
                  @error('name') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>   
              </div>
  
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="email" class="form-label">Email:</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="" name="email"  value="{{old('email')}}">
                  @error('email') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>  
              </div>
            </div>

            
          <div class="row">                        
            <div class="col-md-6">
              <div class="mb-3">
                <label for="Name" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"  placeholder="" name="password">
                @error('password') <span class="invalid-feedback">{{$message}}</span> @enderror
              </div>   
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="email" class="form-label ">confirm password</label>
                <input type="password" class="form-control  @error('cpassword') is-invalid @enderror" id="cpassword" placeholder="" name="cpassword">
                @error('cpassword') <span class="invalid-feedback">{{$message}}</span> @enderror
              </div>  
            </div>
          </div>

          <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="contact" class="form-label">Select Package</label>
                      <select name="package" id="getfee" class="form-control @error('package') is-invalid @enderror">
                        @if(empty(old('package')))
                            <option value="" disabled selected>Select Package</option>
                        @else
                            <option value="" disabled>Select Package</option>
                        @endif
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" @if(old('package') == $package->id) selected @endif>
                                {{ $package->package_name }} ({{ $package->package_duration }} months)
                            </option>
                        @endforeach
                      </select>
                        @error('package') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
            </div>
        
            <div class="col-6">
                <div class="mb-3">
                    <label for="contact" class="form-label ">Fee</label>
                    <input type="text" id="fee" name="fee" class="form-control  @error('fee') is-invalid @enderror "  value="{{ old('fee') }}">
                    @error('fee') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
            </div>
          </div>

  
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="start-date" class="form-label ">Start Date</label>
                  <input type="date" class="form-control  @error('startdate') is-invalid @enderror " id="start-date" name="startdate"  value="{{ old('startdate') }}">
                    @error('startdate') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
              </div>
  
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="end-date" class="form-label ">End Date</label>
                  <input type="date" class="form-control  @error('enddate') is-invalid @enderror " id="end-date" name="enddate"  value="{{ old('enddate') }}">
                    @error('enddate') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
              </div>
            </div>

            
  
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="bodyweight" class="form-label">Body Weight</label>
                  <input type="text" class="form-control  @error('bodyweight') is-invalid @enderror " id="bodyweight" name="bodyweight"  value="{{ old('bodyweight') }}" >
                   @error('bodyweight') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
              </div>
  
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="height" class="form-label">Height</label>
                  <input type="text" class="form-control  @error('height') is-invalid @enderror " id="height" name="height"  value="{{ old('height') }}" >
                   @error('height') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="mnum" class="form-label">Contact</label>
                  <input type="text" class="form-control @error('contact') is-invalid @enderror  " id="contact" name="contact"  value="{{ old('contact') }}" >
                   @error('contact') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control @error('address') is-invalid @enderror " id="address" name="address"  value="{{ old('address') }}" >
                   @error('address') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
              </div>
            </div>
  
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="mnum" class="form-label">Medical conditions </label>
                  <input type="text" class="form-control  @error('medical_condition') is-invalid @enderror " id="medical_condition" name="medical_condition" placeholder="Leave empty if none">
                   @error('medical_condition') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="contact" class="form-label">Assign Trainer</label>
                  <select class="form-control @error('assigned_trainer') is-invalid @enderror" id="contact" name="assigned_trainer">
                    
                    @if( empty(old('contact')) )
                      <option value="" disabled selected>Select a trainer</option>
                    @else
                      <option value="" disabled >Select a trainer</option>
                    @endif
                   
                    @foreach($trainers as $trainer)
                     <option value="{{$trainer->id}}" @if(old('assigned_trainer') == $trainer->id) selected @endif>{{$trainer->name}}</option>
                    @endforeach
                    <!-- Add more options here with your dummy data -->
                  </select>
                  @error('assigned_trainer') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
              </div>

            </div>
  
            
            
            
          
  
            <div class="row">
              
              <div class="col-6">
                <fieldset class="form-group">
                  <legend>Goal</legend>
  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="goal[]" id="muscleGain" value="MG" {{ (is_array(old('goal')) && in_array('MG', old('goal'))) ? 'checked' : '' }}  />
                    <label class="form-check-label" for="muscleGain">Muscle Gain</label>
                  </div>
  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="goal[]" id="fatLoss" value="FL" {{ (is_array(old('goal')) && in_array('FL', old('goal'))) ? 'checked' : '' }}   />
                    <label class="form-check-label" for="fatLoss">Fat Loss</label>
                  </div>
  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="goal[]" id="generalFitness" value="GF"  {{ (is_array(old('goal')) && in_array('GF', old('goal'))) ? 'checked' : '' }}  />
                    <label class="form-check-label" for="generalFitness">General Fitness</label>
                  </div>
                </fieldset>
                @error('goal') <span class="text-danger mt-3">{{$message}}</span> @enderror
              </div>
  
              <div class="col-6  ">
                <fieldset class="form-group">
                  <legend>Gender</legend>
  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="M" @if (old('gender') == 'M') checked @endif/>
                    <label class="form-check-label" for="male">Male</label>
                  </div>
  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="F" @if (old('gender') == 'F') checked @endif />
                    <label class="form-check-label" for="female">Female</label>
                  </div>
  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="O" @if (old('gender') == 'O') checked @endif/>
                    <label class="form-check-label" for="other">Other</label>
                  </div>
                </fieldset>
                @error('gender') <span class="text-danger mt-3">{{$message}}</span> @enderror
              </div>
            </div>
            
  
            <div class="row">
              <div class="col-12">
                <div class="form-group mt-3">
                  <button type="submit" class="btn bg-primary btn-lg w-100 text-white">Submit</button>
                </div>
            </div>
                                 
          </form>  
       
      </div>
    </div>
  </div>

  <script>
    $('#getfee').on('change',function()
    {
      const id = $(this).val();
      $.ajax({
        url:"{{ route('get.fee') }}",
        type:"get",
        data:{
          id:id
        },
        success:function(response)
        {
          var price = response.package_price;
          $('#fee').val(price);
        }
      });
    });
  </script>

  @include('backend.admin.layouts.footer');
</body>

</html>