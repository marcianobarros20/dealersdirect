<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li class="">
                            <a href="{{ url('/')}}/admin/home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-automobile fa-fw"></i> Vehicles <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/')}}/admin/make">Make</a>
                                </li>
                                <li>
                                    <a href="{{ url('/')}}/admin/model">Model</a>
                                </li>
                                <li>
                                    <a href="{{ url('/')}}/admin/year">Year</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{ url('/')}}/admin/dealers"><i class="fa fa-group fa-fw"></i> Dealers</a>
                        </li>
                        <li>
                            <a href="{{ url('/')}}/admin/request"><i class="fa fa-th-list fa-fw"></i> Requests</a>
                        </li>
                        <li>
                            <a href="{{ url('/')}}/admin/price"><i class="fa fa-group fa-fw"></i> Set Price</a>
                        </li>

                         <li>
                            <a href="{{ url('/')}}/admin/loan"><i class="fa fa-group fa-fw"></i> Set Loan Details</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>