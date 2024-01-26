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
        <div class="d-flex justify-content-between">
            <div>
                <h1>Add Workout</h1>
            </div>

            <div>
                <a href="{{ route('view.client', ['id' => $client->id]) }}">
                    <button class="btn btn-primary">Back to my client</button>
                </a>
            </div>

            
        </div>

       

        <div class="container">
            <div class="row mt-5">
                @foreach($daysOfWeek as $day)
                <div class="card">
                    <div class="card-body">
                        <form method="POST" class="workout-form" >
                            @csrf
                            <div class="action-box d-flex">
                                <div>
                                    <h3>{{$day}}</h3>
                                    <input type="hidden" value="{{$day}}" name="day">
                                    <input type="hidden" value="{{$client->id}}" id="client-id">
                                </div>

                                <div>
                                    <button class="form-control btn btn-success ms-2 add-div">+</button>
                                </div>
                                
                            </div>

                            <div class="row mt-3 workout-row">
                                <div class="col-4">
                                    <label for="exercise_name">Exercise Name</label>
                                    <input type="text" id="exercise_name" name="exercise_name[]" class="form-control">
                                </div>
    
                                <div class="col-1">
                                    <label for="sets">Sets</label>
                                    <input type="text" id="sets" name="sets[]" class="form-control">
                                </div>
    
                                <div class="col-1">
                                    <label for="reps">Reps</label>
                                    <input type="text" id="reps" name="reps[]" class="form-control">
                                </div>
    
                                <div class="col-2">
                                    <label for="reference">Reference</label>
                                    <input type="text" id="reference" name="reference[]" class="form-control">
                                </div>
    
                                <div class="col-2">
                                    <label for="instructions">Instructions</label>
                                    <input type="text" id="instructions" name="instructions[]" class="form-control">
                                </div>

                                <div class="col-1 mt-4">
                                    <button class="form-control btn btn-danger remove-div" disabled>-</button>
                                </div>
                            </div>

                            <div class="row mt-2 d-flex justify-content-end">
                                <div class="col-3 d-flex justify-content-end ">
                                    <button type="submit" class=" btn btn-success submit-workout">Add</button>
                                </div>
                               
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach    
            </div>
        </div>
      </div>

      <script>
       $(document).ready(function () 
       {
            $('.add-div').on('click', function (e) {
                e.preventDefault();
                var cardBody = $(this).closest('.card-body');
                var firstWorkoutRow = cardBody.find('.workout-row:first');
                var clonedRow = firstWorkoutRow.clone();
                cardBody.find('.workout-row:last').after(clonedRow);
                clonedRow.find('.remove-div').prop('disabled', false);
            });

            $(document).on('click', '.remove-div', function(e) {
                e.preventDefault();
                $(this).closest('.workout-row').remove();
            });

            $('.workout-form').on('submit', function(e) { // Changed event to submit
                e.preventDefault();
                const clientid = $('#client-id').val(); // Find the client ID within this form
                const formData = $(this).serialize(); 

                $.ajax({
                    url: "{{ route('save.workout') }}",
                    type: "POST",
                    data: {
                        clientid: clientid,
                        formData: formData,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message, 'Success');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    

      

    
    
    
    
    
  @include('backend.trainer.layouts.footer')
</body>

</html>