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
            <h1>Add Trainer</h1>
          </div>

          <div>
            <a class="btn btn-primary" href="{{ route('view.trainers_list') }}">View Trainers</a>
          </div>
       
        </div>
    
        <form class="form-control mt-2 p-3" action="{{ route('create.addtrainer') }}" id="addclientform" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder=""
                  name="name" value="{{ old('name') }}">

                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder=""
                  name="email" value="{{ old('email') }}">

                @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                  placeholder="" name="password">

                @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control @error('cpassword') is-invalid @enderror" id="cpassword"
                  placeholder="" name="cpassword">

                @error('cpassword')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="start-date" class="form-label">Start Date</label>
                <input type="date" class="form-control @error('startdate') is-invalid @enderror" id="start-date"
                  name="startdate" value="{{ old('startdate') }}">

                @error('startdate')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary"
                  value="{{ old('salary') }}">

                @error('salary')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="bodyweight" class="form-label">Body Weight</label>
                <input type="text" class="form-control @error('bodyweight') is-invalid @enderror" id="bodyweight"
                  name="bodyweight" value="{{ old('bodyweight') }}">

                @error('bodyweight')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="height" class="form-label">Height</label>
                <input type="text" class="form-control @error('height') is-invalid @enderror" id="height" name="height"
                  value="{{ old('height') }}">

                @error('height')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="tnum" class="form-label">Trainer Number</label>
                <input type="text" class="form-control @error('tnum') is-invalid @enderror" id="tnum" name="tnum"
                  value="{{ old('tnum') }}">

                @error('tnum')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="dob" class="form-label ">Date of birth</label>
                <input type="date" class="form-control  @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob') }}">
                
                @error('dob')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact"
                  name="contact" value="{{ old('contact') }}">

                @error('contact')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
                @error('address')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="medical_condition" class="form-label">Medical conditions</label>
                <input type="text" class="form-control" id="medical_condition" name="medical_condition"
                  placeholder="Leave empty if none" value="{{ old('medical_condition') }}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="picture" class="form-label">Picture</label>
                <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture"
                name="picture[]" multiple>
                @error('picture')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="mb-3">
                <label for="documents" class="form-label">Official Documents</label>
                <input type="file" class="form-control @error('documents') is-invalid @enderror" id="documents"
                  name="documents[]" multiple>
                @error('documents')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="mb-3">
                <label for="certifications" class="form-label">Certifications</label>
                <input type="file" class="form-control @error('certifications') is-invalid @enderror"
                  id="certifications" name="certifications[]" multiple>
                @error('certifications')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-6">
              <fieldset class="form-group">
                <legend>Programs</legend>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input " type="checkbox" name="program[]"
                    id="gymPackage" value="G" {{ (is_array(old('program')) && in_array('G', old('program'))) ? 'checked' : '' }}
                     />
                  <label class="form-check-label" for="gymPackage">Gym</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input " type="checkbox" name="program[]"
                    id="cardioPackage" value="C" {{ (is_array(old('program')) && in_array('C', old('program'))) ? 'checked' : '' }}
                     />
                  <label class="form-check-label" for="cardioPackage">Cardio</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input " type="checkbox" name="program[]"
                    id="boxingPackage" value="BX" {{ (is_array(old('program')) && in_array('BX', old('program'))) ? 'checked' : '' }}
                     />
                  <label class="form-check-label" for="boxingPackage">Boxing</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input " type="checkbox" name="program[]"
                    id="crossfitPackage" value="CF"
                    {{ (is_array(old('program')) && in_array('CF', old('program'))) ? 'checked' : '' }}  />
                  <label class="form-check-label" for="crossfitPackage">Cross-fit</label>
                </div>
              
              </fieldset>

              @error('program')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          
            <div class="col-6">
              <fieldset class="form-group">
                <legend>Skills</legend>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="skills[]" id="muscleGain"
                    value="MG" {{ (is_array(old('skills')) && in_array('MG', old('skills'))) ? 'checked' : '' }}  />
                  <label class="form-check-label" for="muscleGain">Muscle Gain</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="skills[]" id="fatLoss"
                    value="FL" {{ (is_array(old('skills')) && in_array('FL', old('skills'))) ? 'checked' : '' }}  />
                  <label class="form-check-label" for="fatLoss">Fat Loss</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="skills[]"
                    id="generalFitness" value="GF" {{ (is_array(old('skills')) && in_array('GF', old('skills'))) ? 'checked' : '' }}
                     />
                  <label class="form-check-label" for="generalFitness">General Fitness</label>
                </div>
              </fieldset>

              @error('skills')
              <span class="text-danger">{{$message}}</span>
              @enderror

            </div>
          </div>
          
          <div class="row mt-2">
            <div class="col-6 mt-3">
              <fieldset class="form-group">
                <legend>Mode</legend>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="mode[]" id="modeoffline"
                    value="online" {{ (is_array(old('mode')) && in_array('online', old('mode'))) ? 'checked' : '' }}  />
                  <label class="form-check-label" for="modeoffline">Online</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="mode[]" id="modeonline"
                    value="offline" {{ (is_array(old('mode')) && in_array('offline', old('mode'))) ? 'checked' : '' }}
                     />
                  <label class="form-check-label" for="modeonline">Offline</label>
                </div>
             
              </fieldset>

              @error('mode')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          
            <div class="col-6 mt-3">
              <fieldset class="form-group">
                <legend>Gender</legend>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="male" value="M"
                    {{ (old('gender') == 'M') ? 'checked' : '' }}  />
                  <label class="form-check-label" for="male">Male</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="female"
                    value="F" {{ (old('gender') == 'F') ? 'checked' : '' }}  />
                  <label class="form-check-label" for="female">Female</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="other"
                    value="O" {{ (old('gender') == 'O') ? 'checked' : '' }}  />
                  <label class="form-check-label" for="other">Other</label>
                </div>
              </fieldset>

              @error('gender')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          

          <div class="row mt-3">
            <div class="col-12">
              <div class="form-group mt-3">
                <button type="submit" class="btn bg-primary btn-lg w-100 text-white">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!--  Main wrapper End -->
    <!--  Scripts -->
    @include('backend.admin.layouts.footer');
  </div>
  <!--  Body Wrapper End -->
</body>
</html>
