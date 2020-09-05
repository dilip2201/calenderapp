    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed navbar-shadow navbar-brand-center">
        
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a style="padding: 0px;
    border: 1px solid #000;
    border-radius: 50%;
    width: 53px;
    height: 53px;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    display: inline-flex;" class="nav-link" href="{{ url('admin/dashboard') }}" data-toggle="tooltip" data-placement="top"><img src="{{ URL::asset('public/images/favicon.png') }}" style="    height: 45px;"></a></li>
                           
                        </ul>
                       
                    </div>
                    @if(auth()->user()->image)
                    <?php $img = auth()->user()->image; ?>
                    @else
                    <?php $img = 'default.png'; ?>
                    @endif
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ 
                                    ucfirst(Auth::user()->name)}}</span><span class="user-status">{{ Auth::user()->email}}</span></div><span><img class="round" src="{{ URL::asset('public/company/employee/'.$img) }}" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ route('admin.profile')}}"><i class="feather icon-user"></i> Edit Profile</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather icon-power"></i> Logout</a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>