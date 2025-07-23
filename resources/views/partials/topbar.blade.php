<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            
            <div class="navbar-brand-box">
               

                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo.svg') }}" alt="" height="22" class="my-3">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/logo-dark.png') }}" alt="" height="19" class="px-3 my-3">
                    </span>
                </a> 
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            
           
        </div>

        <div class="d-flex">
            

        

            <div class="dropdown d-inline-block"
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('images/users/user-dummy-img.jpg') }}" 
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a disabled class="dropdown-item text-primary" href="#">
                        <i class="bx bx-user font-size-16 align-middle me-1 text-primary"></i> <span key="t-logout">{{$user_name.' ('.$rol.')'}}</span>
                    </a>
                    <a class="dropdown-item text-danger" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div> 

            

        </div>
    </div>
</header>