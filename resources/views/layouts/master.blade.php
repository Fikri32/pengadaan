<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        @include('layouts/incl_top')
    </head>
    <body>
    <div id="page-container" class="sidebar-o sidebar-inverse side-scroll  page-header-glass page-header-inverse main-content-boxed">
            <nav id="sidebar">
            @role('super-admin')
                    @include('layouts/sidebar/admin')
                @else
                    @include('layouts/sidebar/users')
                @endrole
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                @include('layouts/header')
            </header>

            <!-- END Header -->
            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                @yield('content')
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">

                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->
        @include('layouts/incl_bottom')
        @stack('scripts')
        @include('sweetalert::alert')
    </body>
</html>
