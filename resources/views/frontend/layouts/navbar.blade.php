<div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="" class="navbar-brand">
            <h1 class="m-0 display-4 font-weight-bold text-uppercase text-white">Gymnast</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4 bg-secondary">
                <a href="{{route('view.home')}}" class="nav-item nav-link">Home</a>
                <a href="{{route('view.about')}}" class="nav-item nav-link">About Us</a>
                <a href="{{route('view.feature')}}" class="nav-item nav-link">Our Features</a>
                <a href="{{route('view.classes')}}" class="nav-item nav-link">Classes</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu text-capitalize">
                        <a href="{{ route('view.home') }}" class="dropdown-item">Login </a>
                        <a href="{{ route('view.home') }}" class="dropdown-item">Trainer Login</a>
                    </div>
                </div>
                <a href="{{route('view.contact')}}" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
</div>