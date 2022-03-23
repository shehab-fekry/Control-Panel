<!DOCTYPE html> 
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        
    </title>
    
    <link rel="icon" href="{{ asset("assets/images/tracking.svg") }}">
    <!-- bootstarp -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
    <!--   Fonts   -->
    <link href="http://fonts.cdnfonts.com/css/cera-round-pro" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset("css/layout.css") }}" rel="stylesheet">
    <link href="{{ asset("css/landingPage.css") }}" rel="stylesheet">
    <link href="{{ asset("css/tracking.css") }}" rel="stylesheet">
    <link href="{{ asset("css/Drivers.css") }}" rel="stylesheet">
    <link href="{{ asset("css/Parents.css") }}" rel="stylesheet">
    <link href="{{ asset("css/confirmEmail.css") }}" rel="stylesheet">
    <link href="{{ asset("css/home.css") }}" rel="stylesheet">
    <link href="{{ asset("css/adminProfile.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/parentDriver.css") }}/Public/css/parentDriver.css">



    <!--   mapbox  -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
    <!--  Pusher   -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- Chart.js  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <!-- Typed.js  -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <!--   Axios   -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://use.fontawesome.com/e8ca812c5b.js"></script>

    <!--   ReCaptcha   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>

<body>

    <div class="sideBar">

        <div class="top-side-bar">
            <div class="notification-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                <i class="fa fa-bell"></i>
            </div>
    
            <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasTopLabel">Notification Panel</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="info_section"></div>
                <div class="info_section"></div>
            </div>
            </div>

            <div class="sidebar-user">
                <img src="{{asset('upload/admin/'.Auth::user()->image_path)}} "  class="sidebar-img">
                <h2>   {{ Auth::user()->name }} </h3>
                <h4> School Manager </h4>
               
            </div>
        </div>

        <ul class="list-group">
            <a href="{{route('home')}}">     
                <li class="list-group-item mt-2"><i class="fa fa-home" aria-hidden="true"></i> &nbsp; Dashboard</li>
            </a>
            @if (Auth::user()->school_id == NULL)
            <a href="{{route('school.index', Auth::user()->id)}}">     
            @else
               <a href="{{route('school.index', Auth::user()->school_id)}}">     
            @endif
            <li class="list-group-item mt-2"><i class="fa fa-university" aria-hidden="true"></i> &nbsp; School</li>
            </a> 
            <a><li class="list-group-item mt-2" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-trips" aria-expanded="false">
                <i class="fa fa-subway"></i> &nbsp;Trips </li>
                <div class="collapse" id="dashboard-collapse-trips">
                    <ul class="btn-toggle-nav list-unstyled">
                        <li><a href="{{ route('trip.index') }}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-cog"></i> &nbsp;Tracking</a></li>
                        <li><a href="{{route('trip.indextrip')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-sign-out"></i> &nbsp; Update Trips </a></li>
                    </ul>
                </div>
            </a>
            <a><li class="list-group-item mt-2" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-1" aria-expanded="false">
                <i class="fa fa-id-card"></i> &nbsp;Drivers</li>
                <div class="collapse" id="dashboard-collapse-1">
                    <ul class="btn-toggle-nav list-unstyled">
                        <li><a href="{{route('driver.index')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-cog"></i> &nbsp;Show Drivers</a></li>
                        <li><a href="{{route('driver.create')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-sign-out"></i> &nbsp;Add New Driver</a></li>
                    </ul>
                </div>
            </a>

            <a><li class="list-group-item mt-2" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-2" aria-expanded="false">
                <i class="fa fa fa-users"></i> &nbsp;Parents</li>
                <div class="collapse" id="dashboard-collapse-2">
                    <ul class="btn-toggle-nav list-unstyled">
                        <li><a href="{{route('father.index')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-cog"></i> &nbsp;Show Parents</a></li>
                        <li><a href="{{route('father.create')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-sign-out"></i> &nbsp;Add New Parent</a></li>
                    </ul>
                </div>
            </a>

            <a><li class="list-group-item mt-2" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-vehicles" aria-expanded="false">
                <i class="fa fa-bus"></i> &nbsp;Vehicles </li>  
                <div class="collapse" id="dashboard-collapse-vehicles">
                  <ul class="btn-toggle-nav list-unstyled">
                    <li><a href="{{route('vehicle.index')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-cog"></i> &nbsp;Show Vehicles</a></li>
                    <li><a href="{{route('vehicle.create')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-sign-out"></i> &nbsp;Add Vehicle</a></li>
                  </ul>
                </div>
            </a>


            <a><li class="list-group-item mt-2" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-profile" aria-expanded="false">
                <i class="fa fa-user-circle"></i> &nbsp;Admin </li>  
                <div class="collapse" id="dashboard-collapse-profile">
                  <ul class="btn-toggle-nav list-unstyled">
                    <li><a href="{{route('admin.index')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-cog"></i> &nbsp;Admin Profile</a></li>
                    <li><a href="{{route('admin.edit',Auth::user()->id)}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-cog"></i> &nbsp;Edit Profile</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                         class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-sign-out"></i> &nbsp;{{ __('Logout') }}
                         <form id="logout-form" action="{{ route('logout') }}" method="POST"
                         class="d-none">
                         @csrf
                     </form>
                        
                        </a>
                    
                    </li>
                  </ul>
                </div>
            </a>            

        
        </ul>
    </div>

    <div class="content">
        <!-- content of other pages here... -->
        @yield("content")
    </div>
 
    <!-- index.js  -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset("js/index.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html> 