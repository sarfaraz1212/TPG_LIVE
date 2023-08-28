@include('backend.admin.layouts.navbar');

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('backend.admin.layouts.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <style>
      .cross-button {
        display: inline-block;
        width: 20px;
        height: 20px;
        background-color: #f1f1f1;
        border-radius: 50%;
        text-align: center;
        line-height: 20px;
        cursor: pointer;
        transition: background-color 0.3s;
      }
    
      .cross-button:hover {
        background-color: #e0e0e0;
      }
    
      .cross-button a {
        text-decoration: none;
        color: black;
        font-weight: bold;
      }
    </style>
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('backend.admin.layouts.header');
      <!--  Header End -->
      <div class="container-fluid">

        <div class="">
          <div>
            <h1>Edit Trainer</h1>
          </div>
        </div>


    
        <form class="form-control mt-2 p-3" action="{{ route('edit.trainer',['id' => $trainer->id],) }}" id="addclientform" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="" value="{{$trainer->name}}"
                  name="name">
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder=""
                  name="email" value="{{ $trainer->email }}" readonly>
                @error('email')
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
                  name="startdate" value="{{ $trainer->start_date }}">

                @error('startdate')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary"
                  value="{{ $trainer->salary }}">

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
                  name="bodyweight" value="{{ $trainer->body_weight }}">

                @error('bodyweight')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="height" class="form-label">Height</label>
                <input type="text" class="form-control @error('height') is-invalid @enderror" id="height" name="height"
                  value="{{ $trainer->height }}">

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
                  value="{{ $trainer->trainer_number}}" re>

                @error('tnum')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="dob" class="form-label ">Date of birth</label>
                <input type="date" class="form-control  @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ $trainer->dob }}">
                
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
                  name="contact" value="{{ $trainer->contact }}">

                @error('contact')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{$trainer->address}}">
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
                  placeholder="Leave empty if none" value="{{$trainer->medical_condition}}">
              </div>
            </div>
          </div>

          <div class="row">
            @php 
                $imageArray = [];
                $certificateArray = [];
                $documentsArray = [];

                if (!empty($trainer->picture)) {
                    $imageArray = explode(',', $trainer->picture);
                }

                if (!empty($trainer->documents)) {
                  $documentsArray   = explode(',',$trainer->documents);
                }
                if (!empty($trainer->certifications)) {
                  $certificateArray   = explode(',',$trainer->certifications);
                }
             

               
               
        
            @endphp
           <div class="d-flex">
                @if(count($imageArray) > 0)
                    <div class="d-flex">
                        @foreach($imageArray as $key => $image)
                            <div class="image-wrapper">
                                <img src="{{ asset('images/TrainerImage/' . $image) }}" alt="" id="img1" class="ms-2" style="width: 500px">
                                <span><p class="cross-button dltimg" data-name="{{ $image }}" data-key="{{ $key }}" data-id="{{ $trainer->id }}">X</p></span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        

          

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

            <div class="d-flex">
              @if(count($documentsArray) > 0)
                @foreach($documentsArray  as  $document)
                <div class="doc-wrapper">
                  <iframe src="{{ asset('images/TrainerDocuments/' . $document) }}" class="ms-3" frameborder="0" width="300" height="300"></iframe>
                  <span><p class="cross-button dltdoc" data-name="{{ $document }}"  data-value="{{ $trainer->id }}">X</p></span>
                </div>
                @endforeach
              @endif
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

            <div class="d-flex">
              @if(count($certificateArray) > 0)
                @foreach($certificateArray as $certificate)
                <div class="certificate-wrapper">
                  <iframe src="{{ asset('images/TrainerCertifications/' . $certificate) }}" class="ms-3" frameborder="0" width="300" height="300"></iframe>
                  <span><p class="cross-button dltcertificate" data-name="{{ $certificate }}" data-value="{{ $trainer->id }}">X</p></span>
                </div>
                @endforeach
              @endif
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
                    <input class="form-check-input" type="checkbox" name="programs[]" {{ in_array('G', $programArray) ? 'checked' : '' }} id="gymPackage" value="G" />
                  <label class="form-check-label" for="gymPackage">Gym</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input " type="checkbox" name="programs[]" {{ in_array('C', $programArray) ? 'checked' : '' }} id="cardioPackage" value="C" />
                  <label class="form-check-label" for="cardioPackage">Cardio</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input " type="checkbox" name="programs[]" {{ in_array('BX', $programArray) ? 'checked' : '' }} id="boxingPackage" value="BX" />
                  <label class="form-check-label" for="boxingPackage">Boxing</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input " type="checkbox" name="programs[]"
                    id="crossfitPackage" value="CF"
                      />
                  <label class="form-check-label" for="crossfitPackage">Cross-fit</label>
                </div>
              
              </fieldset>

              @error('package')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          

            <div class="col-6">
              <fieldset class="form-group">
                <legend>Skills</legend>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="skills[]" id="muscleGain" value="MG" {{ in_array('MG',$goalArray)? 'checked':'' }}/>
                  <label class="form-check-label" for="muscleGain">Muscle Gain</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="skills[]" id="fatLoss" value="FL"  {{ in_array('FL',$goalArray)? 'checked':'' }}/>
                  <label class="form-check-label" for="fatLoss">Fat Loss</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="skills[]" id="generalFitness" value="GF"{{ in_array('GF',$goalArray)? 'checked':'' }}/>
                  <label class="form-check-label" for="generalFitness">General Fitness</label>
                </div>
              </fieldset>

              @error('goal')
              <span class="text-danger">{{$message}}</span>
              @enderror

            </div>
          </div>
          
          
       

          <div class="row mt-2">
            <div class="col-6 mt-3">
              <fieldset class="form-group">
                <legend>Mode</legend>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="mode[]" id="modeoffline" value="online"  {{ in_array('online',$modeArray)?'checked':'' }}/>
                  <label class="form-check-label" for="modeoffline">Online</label>
                </div>
          
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="mode[]" id="modeonline" value="offline" {{ in_array('offline',$modeArray)?'checked':'' }}/>
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
                    <input class="form-check-input" type="radio" name="gender" id="male" value="M" {{ $trainer->gender == 'M' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male">Male</label>
                  </div>
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="F" {{ $trainer->gender == 'F' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female">Female</label>
                  </div>
                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="O" {{ $trainer->gender == 'O' ? 'checked' : '' }}>
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
   
    <script>
      $(document).ready(function() {
          $('.dltimg').on('click', function() {
        
              const key = $(this).data('key');
              const id = $(this).data('id');

              var imageName = $(this).data('name');
  
              var thisimg = $(this).closest('.image-wrapper');
              var crossButton = $(this);
  
              // Show SweetAlert confirmation dialog
              Swal.fire({
                  title: 'Are you sure?',
                  text: 'Do you want to delete this image?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, delete it!',
                  cancelButtonText: 'No, cancel',
              }).then((result) => {
                  if (result.isConfirmed) {
                      // User confirmed, proceed with AJAX request
                      $.ajax({
                          url: "{{ route('delete.trainer-image') }}",
                          type: "get",
                          data: {
                              imageName:imageName,
                              id:id,
                          },
                          success: function(response) {
                              thisimg.addClass('d-none');
                              crossButton.addClass('d-none');
                          },
                          error: function(error) {
                              // Handle the error response here
                          }
                      });
                  }
              });
          });

          $('.dltdoc').on('click',function()
          {
            const key     = $(this).data('key');
            const id      = $(this).data('value');
            const docname = $(this).data('name');
            var thisimg = $(this).closest('.doc-wrapper');
            var crossButton = $(this);
  

            Swal.fire({
                  title: 'Are you sure?',
                  text: 'Do you want to delete this document?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, delete it!',
                  cancelButtonText: 'No, cancel',
              }).then((result) => {
                  if (result.isConfirmed) {
                      // User confirmed, proceed with AJAX request

                      $.ajax({
                          url: "{{ route('delete.trainer-document') }}",
                          type: "get",
                          data: {
                              docname:docname,
                              id:id,
                          },
                          success: function(response) {
                            
                              thisimg.addClass('d-none');
                              crossButton.addClass('d-none');
                          },
                          error: function(error) {
                              // Handle the error response here
                          }
                      });
                  }
              });
          });

          $('.dltcertificate').on('click',function()
          {
            const key              = $(this).data('key');
            const id               = $(this).data('value');
            const certificate_name = $(this).data('name');
            var thisimg            = $(this).closest('.certificate-wrapper');
            var crossButton = $(this);
  

            Swal.fire({
                  title: 'Are you sure?',
                  text: 'Do you want to delete this certificate?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, delete it!',
                  cancelButtonText: 'No, cancel',
              }).then((result) => {
                  if (result.isConfirmed) {
                      // User confirmed, proceed with AJAX request

                      $.ajax({
                          url: "{{ route('delete.trainer-certificate') }}",
                          type: "get",
                          data: 
                          {
                              certificate_name:certificate_name,
                              id:id,
                          },
                          success: function(response) {
                            
                              thisimg.addClass('d-none');
                              crossButton.addClass('d-none');
                          },
                          error: function(error) {
                              // Handle the error response here
                          }
                      });
                  }
              });
          })

          
      });
  </script>
  
  
  
    @include('backend.admin.layouts.footer');
  </div>
  <!--  Body Wrapper End -->
</body>
</html>
