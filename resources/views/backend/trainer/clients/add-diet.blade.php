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
        <div class="d-flex">
            <div>
                <h1>Add diet</h1>
            </div> 
        </div>
        
      
        <div class="box">
            <form action="{{ route('save.diet',['id' => $client->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="client_id" value="{{$client->id}}">
                <div class="row mt-4 meal-row">
                    <div class="col-5">
                        <label for="" class="meal-label" >Meal 1</label>
                        <input class="form-control" type="text" name="meal[]" >
                    </div>

                    <div class="col-1">
                        <label for="">Protien</label>
                        <input class="form-control" type="text" name="protein[]" id="">
                    </div>

                    
                    <div class="col-1">
                        <label for="">Carbs</label>
                        <input class="form-control" type="text" name="carbs[]" id="">
                    </div>

                    <div class="col-1">
                        <label for="">Fats</label>
                        <input class="form-control" type="text" name="fats[]" id="">
                    </div>
    
                    <div class="col-2">
                        <label for="">Calories</label>
                        <input class="form-control" type="text" name="calories[]" id="">
                    </div>
                    
                  
    
                    <div class="col-1" style="margin-top: 19px;">
                        <!-- The first row's delete button is hidden -->
                        <button class="btn btn-danger remove-row" style="display:none;">-</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 d-flex justify-content-end">
                        <div>
                            <button class="btn btn-success add-row me-2 mt-2">+</button>
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary  mt-2" data-toggle="modal" data-target="#exampleModal">
                                Add
                             </button>
                        </div>

                        

                        
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add diet for {{$client->name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <p>Total Protein: <input type="text" id="total_protein" name="total_protein" class="form-control" value=""></p>
                                    </div>

                                    <div class="col-6">
                                        <p>Total Carbs: <input id="total_carbs" name="total_carbs" class="form-control" value=""></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <p>Total Fats: <input id="total_fats" name="total_fats" class="form-control" value=""></p>
                                    </div>

                                    <div class="col-6">
                                        <p>Total Calories: <input id="total_calories" name="total_calories" class="form-control" value=""></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary d-flex justify-content-end">Submit</button>
                        </div>

                      </div>
                    </div>
                  </div>

                  
            </form>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            
            var mealCounter = 1; // Initialize the meal counter
    
            // Add row
            $('.add-row').on('click', function (e) {
                e.preventDefault();
    
                // Clone the first row
                var newRow = $('.meal-row:first').clone();
    
                // Increment the meal counter and update the label
                mealCounter++;
                newRow.find('.meal-label').text('Meal ' + mealCounter);
    
                // Clear input values in the cloned row
                newRow.find('input[type="text"]').val('');
    
                // Show the delete button for the new row
                newRow.find('.remove-row').show();
    
                // Append the cloned row after the last meal-row
                $('.meal-row:last').after(newRow);
            });
    
            // Remove row
            $('.box').on('click', '.remove-row', function (e) {
                e.preventDefault();
    
                // Remove the clicked row
                $(this).closest('.meal-row').remove();
    
                // Update meal numbers for all remaining rows
                $('.meal-row').each(function (index) {
                    $(this).find('.meal-label').text('Meal ' + (index + 1));
                });
    
                mealCounter--; // Decrement the meal counter
            });
        });

        $('.box').on('change', 'input.form-control', function () {
           var meal = $(this).val();
           var row = $(this).closest('.meal-row');
           $.ajax({
            url: '{{route('create.calories')}}',
            type:"GET",
            data:
            {
                meal:meal,
            },
            success:function(response)
            {
                var protein  = 0;
                var carbs    = 0;
                var calories = 0;
                var fats     = 0;

                const numberOfRecords = response.length;
                for (let i = 0; i < numberOfRecords; i++) 
                {
                    calories += response[i].calories;
                    protein  += response[i].protein_g;
                    carbs    += response[i].carbohydrates_total_g;
                    fats     += response[i].fat_total_g;
                }

                row.find('input[name="protein[]"]').val(protein);
                row.find('input[name="carbs[]"]').val(carbs);
                row.find('input[name="fats[]"]').val(fats);
                row.find('input[name="calories[]"]').val(calories);
                
            }
           });


        });

        $('.box').on('keydown', 'input.form-control', function (e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>

    <script>
            $('#exampleModal').on('show.bs.modal', function () 
            {
             calculateTotalsForModal();
            });

            function calculateTotalsForModal() {
                var totalProtein = 0;
                var totalCarbs = 0;
                var totalFats = 0;
                var totalCalories = 0;

                $('.meal-row').each(function () 
                {
                    var protein = parseFloat($(this).find('input[name="protein[]"]').val()) || 0;
                    var carbs = parseFloat($(this).find('input[name="carbs[]"]').val()) || 0;
                    var fats = parseFloat($(this).find('input[name="fats[]"]').val()) || 0;
                    var calories = parseFloat($(this).find('input[name="calories[]"]').val()) || 0;

                    totalProtein += protein;
                    totalCarbs += carbs;
                    totalFats += fats;
                    totalCalories += calories;
                });

                // Update the modal content
                $('#total_protein').val(totalProtein.toFixed(2));
                $('#total_carbs').val(totalCarbs.toFixed(2));
                $('#total_fats').val(totalFats.toFixed(2));
                $('#total_calories').val(totalCalories.toFixed(2));
            }

    </script>

  @include('backend.trainer.layouts.footer')
</body>

</html>