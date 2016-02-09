<!DOCTYPE html>
<html lang="en">

<head>

    @include('admin.includes.adminhead')
    

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            @include('admin.includes.admintopnav')

            @include('admin.includes.adminsidenav')
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        @yield('content')
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    @include('admin.includes.adminfoot')

</body>

</html>
