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
        <!--  Row 1 -->
      </div>
  @include('backend.client.layouts.footer')
</body>
    

    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div>
                <h1>My Diet</h1>
            </div>
            <div> 
                <h3>added by:{{$trainer->name}}</h3>
            </div>
        </div>

       
        <div class="card shadow-lg" style="width: 100%;">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Meal</th>
                            <th scope="col">Protein</th>
                            <th scope="col">Carbs</th>
                            <th scope="col">Fats</th>
                            <th scope="col">Calories</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diets as $diet)
                        @php
                        $i = 0;
                        @endphp
                        @foreach($diet->meals as $index=>$meal)
                        <tr>
                            @php
                                $proteins = isset($diet->protein[$index]) ? number_format($diet->protein[$index], 1) : '';
                                $carbs = isset($diet->carbs[$index])? number_format($diet->carbs[$index], 1) : '';
                                $fats = isset($diet->fats[$index])? number_format($diet->fats[$index], 1) : '';
                                $calories = isset($diet->calories[$index])? number_format($diet->calories[$index], 1) : '';
                                $i++;
                            @endphp
                            <td>{{ $i }}</td>
                            <td>{{$meal}}</td>
                            <td>{{$proteins}}</td>
                            <td>{{$carbs}}</td>
                            <td>{{$fats}}</td>
                            <td>{{$calories}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="color:black;">{{ number_format($diet->total_protein, 1) }}g</td>
                            <td style="color:black;">{{ number_format($diet->total_carbs, 1) }}g</td>
                            <td style="color:black;">{{ number_format($diet->total_fats, 1) }}g</td>
                            <td style="color:black;">{{ number_format($diet->total_calories, 1) }}Cal</td>
                        </tr>
                      
                        @endforeach
                        
                       
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">Request Change</button>
                </div>
                
            </div>
        </div>
        
    </div>
    
    
    
</html>