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
            <h1>Add Workout</h1>
        </div>

        <div class="container">
            <div class="days mt-5">
                <h3>Select Days</h3>
            </div>
            <div class="box d-flex">
                @foreach($daysOfWeek as $day)
                    <label><input type="checkbox" style="font-size:18px;" class="ms-4 days form-check-input me-1" name="days[]" value="{{$day}}">{{$day}}</label><br>
                @endforeach   
            </div>
        
            <form action="{{ route('save.workout', ['id' => $client->id]) }}" method="POST">
                @csrf
                <div class="workout" id="workoutDiv">
                
                </div>

                <button type="submit">Submit</button>
            </form>
            
        </div>

        

      </div>

      <script>
        $(document).ready(function() {
            var selectedDays = []; // Array to store selected days and their respective card containers
    
            $(".days").on('change', function() {
                var $this = $(this);
                var selectedDay = $this.val();
    
                if ($this.is(':checked')) {
                    // Create a new card and add it to the workoutDiv
                    var exerciseCard = $("<div class='card mt-3'>" +
                        "<div class='card-body'>" +
                            "<div class='row'>" +
                                "<div class='col-9 d-flex'>" +
                                    "<h3 class='card-title'>" + selectedDay + "</h3>" +
                                    "<button style='font-size:10px;' class='ms-2 btn btn-success btn-add-row'>+</button>" +
                                "</div>" +
                            "</div>" +
                            "<div class='exercise-row'>" +
                                "<div class='row'>" +
                                    "<div class='col-2'>" +
                                        "<label>Exercise Name</label>" +
                                        "<input type='text' class='form-control' name='exercise_name[]'>" + // Add name attribute
                                    "</div>" +
                                    "<div class='col-2'>" +
                                        "<label>Sets</label>" +
                                        "<input type='text' class='form-control' name='sets[]'>" + // Add name attribute
                                    "</div>" +
                                    "<div class='col-2'>" +
                                        "<label>Rep Range</label>" +
                                        "<input type='text' class='form-control' name='rep_range[]'>" + // Add name attribute
                                    "</div>" +
                                    "<div class='col-2'>" +
                                        "<label>Reference</label>" +
                                        "<input type='text' class='form-control' name='reference[]'>" + // Add name attribute
                                    "</div>" +
                                    "<div class='col-2'>" +
                                        "<label>Instructions</label>" +
                                        "<input type='text' class='form-control' name='instructions[]'>" + // Add name attribute
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>");
    
                    $("#workoutDiv").append(exerciseCard);
    
                    // Add the selected day and its card container to the array
                    selectedDays.push({
                        day: selectedDay,
                        card: exerciseCard
                    });
    
                    // Enable remove button for the card
                    exerciseCard.find('.btn-remove-row').prop('disabled', false);
    
                    // Add row
                    exerciseCard.find('.btn-add-row').click(function(event) {
                        event.preventDefault(); // Prevent form submission
    
                        var exerciseRow = $("<div class='row mt-2'>" +
                            "<div class='col-2'>" +
                                "<label>Exercise Name</label>" +
                                "<input type='text' class='form-control' name='exercise_name[]'>" + // Add name attribute
                            "</div>" +
                            "<div class='col-2'>" +
                                "<label>Sets</label>" +
                                "<input type='text' class='form-control' name='sets[]'>" + // Add name attribute
                            "</div>" +
                            "<div class='col-2'>" +
                                "<label>Rep Range</label>" +
                                "<input type='text' class='form-control' name='rep_range[]'>" + // Add name attribute
                            "</div>" +
                            "<div class='col-2'>" +
                                "<label>Reference</label>" +
                                "<input type='text' class='form-control' name='reference[]'>" + // Add name attribute
                            "</div>" +
                            "<div class='col-2'>" +
                                "<label>Instructions</label>" +
                                "<input type='text' class='form-control' name='instructions[]'>" + // Add name attribute
                            "</div>" +
                            "<div class='col-1 mt-4'>" +
                                "<button class='btn btn-danger btn-remove-row'>-</button>" +
                            "</div>" +
                        "</div>");
    
                        exerciseCard.find('.exercise-row').append(exerciseRow);
    
                        // Enable remove button for the newly added row
                        exerciseRow.find('.btn-remove-row').prop('disabled', false);
    
                        // Remove row
                        exerciseRow.find('.btn-remove-row').click(function() {
                            if (exerciseCard.find('.row').length > 1) {
                                $(this).closest('.row').remove();
                            }
                        });
                    });
                } else {
                    // Unchecked a day, remove it from the array and the workoutDiv
                    selectedDays = selectedDays.filter(function(item) {
                        if (item.day === selectedDay) {
                            item.card.remove();
                            return false;
                        }
                        return true;
                    });
                }
    
                if (selectedDays.length === 0) {
                    $("#selectedDay").text("Days");
                }
            });
        });
    </script>
    
    
    
    
    
  @include('backend.trainer.layouts.footer')
</body>

</html>