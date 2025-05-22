<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/dashboard_assets/css/styles.css" rel="stylesheet" />
    <link href="/dashboard_assets/cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="/dashboard_assets/cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="/images/logo.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script data-search-pseudo-elements defer src="/dashboard_assets/cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous"></script>
    @stack('style')
    <title>Dashboard</title>
  </head>
  <body>
    <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
        <a class="navbar-brand h-100 text-truncate" href="{{ route('home') }}">
            <img class="img-fluid" src="/images/themenu.png" style="width:15%;height:100%">
             Dashboard
        </a>
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>
        
        <ul class="navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown no-caret mr-2 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="/images/user.jpg"/></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="/images/user.jpg" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name">{{ Auth::user()->name }}</div>
                            <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('setting.index')}}">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Change Password
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    <div class="dropdown-item-icon"><i data-feather="power"></i></div> {{ __('Logout') }}
                 </a>

                 <form id="logout-form" action="{{ route('admin.logout') }}" method="GET" class="d-none">
                     @csrf
                 </form>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <div class="sidenav-menu-heading">Main</div>
                        <a class="nav-link" href="{{ route('home') }}">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="/category">
                            <div class="nav-link-icon"><i data-feather="git-merge"></i></div>
                            Category Product
                        </a>
                        <a class="nav-link" href="{{ route('product.index') }}">
                            <div class="nav-link-icon"><i data-feather="box"></i></div>
                            Product
                        </a>
                        <a class="nav-link" href="{{ route('table.index') }}">
                            <div class="nav-link-icon"><i data-feather="command"></i></div>
                            Table
                        </a>
                        <a class="nav-link" href="{{ route('order.index') }}">
                            <div class="nav-link-icon"><i data-feather="bookmark"></i></div>
                            Order
                        </a>
                        <a class="nav-link" href="{{ route('report.index') }}">
                            <div class="nav-link-icon"><i data-feather="book"></i></div>
                            Report
                        </a>
                        <a class="nav-link" href="{{ route('customer.index') }}">
                            <div class="nav-link-icon"><i data-feather="users"></i></div>
                            Customers
                        </a>
                        {{-- <a class="nav-link" href="#">
                            <div class="nav-link-icon"><i data-feather="user"></i></div>
                           user
                        </a> --}}
                        {{-- <a class="nav-link" href="{{ route('dashboard.pengiriman.index') }}">
                            <div class="nav-link-icon"><i data-feather="clipboard"></i></div>
                           Pengiriman
                        </a> --}}
                        <a class="nav-link" href="{{route('setting.index')}}">
                            <div class="nav-link-icon"><i data-feather="settings"></i></div>
                           Setting
                        </a>
                        <a class="nav-link" href="{{route('admin.logout')}}">
                            <div class="nav-link-icon"><i data-feather="power"></i></div>
                           Log Out
                        </a>
                        {{-- <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form> --}}
                    </div>
                </div>
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title">{{Auth::user()->name}}</div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            <footer class="footer mt-auto footer-light">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 small">Copyright &#xA9; {{date('Y')}}</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="/dashboard_assets/code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/dashboard_assets/cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/assets/demo/chart-area-demo.js"></script>
    <script src="/dashboard_assets/assets/demo/chart-bar-demo.js"></script>
    <script src="/dashboard_assets/assets/demo/chart-pie-demo.js"></script>
    <script src="/dashboard_assets/cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/assets/demo/datatables-demo.js"></script>
    <script src="/dashboard_assets/cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/assets/demo/date-range-picker-demo.js"></script>
    <script>
        $(document).ready(function (){
            
        });
    </script>
    @stack('script')
    
  </body>
</html>