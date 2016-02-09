    <!DOCTYPE html>
<html lang="en">
    <head>

    <!-- Meta Tags
================================================== -->
    <meta charset="utf-8">
    <meta name="description" content="Carell - Premium Car Dealership Template">
    <meta name="keywords" content="responsive, creative, html/css, theme, multicolor" />
    <meta name="author" content="Predrag Stojanovic - @pebas - http://themeforest.net/user/pebas">

    <!-- Site Title
================================================== -->
    <title>{{ $title }}</title>

    <!-- Mobile Specific Metas
================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
================================================== -->
    <link rel="stylesheet" href="<?php echo url('/');?>/public/front/css/style.css">

    <!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

    <!-- Favicon
================================================== -->
    <link rel="shortcut icon" href="<?php echo url('/');?>/public/front/images/faviconnew.ico" type="image/x-icon">

    <!-- Google Analytics
================================================== -->
    
    </head>

    <body>
    <!-- ================================================== HEADER ================================================== -->
    <header>

        <!-- top bar -->
        <div class="top-bar">
            <div class="container">
                <div class="row">

                    <!-- notification -->
                    <div class="notification">
                        
                    </div>
                    <!-- .notification -->

                    <!-- call us -->
                    
                    <!-- .call us -->

                    <!-- social -->
                    
                    <!-- social -->

                </div>
            </div>
        </div>
        <!-- .top bar -->

        <!-- navigation and logo -->
        <div class="navigation clearfix">
            <div class="container">
                <div class="row">

                    <!-- logo -->
                    <div class="logo">
                        <a href="<?php echo url('/');?>/dealer-dashboard">
                            <img src="<?php echo url('/');?>/public/front/images/logonew.png" title="DealersDirect" alt="DealersDirect" />
                        </a>
                    </div>
                    <!-- .logo -->

                    <!-- navigation -->
                    <nav>

                        <!-- navigation wrap -->
                        <div class="main-nav">



                            <!-- main navigation -->
                            <ul class="main-navigation nav-1 inline">


                                <!-- home -->
                <li><a href="<?php echo url('/');?>/dealer-dashboard" class="active">Dashboard</a>

                </li>
                  <!-- .home --> 
                  
                  <!-- pages -->
                <li><a href="<?php echo url('/');?>/dealer/profile">Profile</a>

                </li>
                  <!-- .pages --> 
                @if(Session::get('dealer_parent')==0)
                <li><a href="<?php echo url('/');?>/dealer/admins">Admins</a>

                </li>
                @endif  
                  <!-- blog -->
                <li><a href="<?php echo url('/');?>/dealer/dealer_make">Makes</a>

                </li>
                  <!-- .blog --> 
                  <!-- blog -->
                <li><a href="<?php echo url('/');?>/dealers/request_list">Request</a>
                
                </li>
                  <!-- .blog --> 
                  <!-- cars -->
                <li><a href="<?php echo url('/');?>/dealer_sign_out">Log-out</a>

                </li>
                  <!-- .cars --> 

                            </ul>
                            <!-- .main navigation -->

                        </div>
                        <!-- .navigation wrap -->

                    </nav>
                    <!-- .navigation -->
                </div>
            </div>
        </div>
        <!-- .navigation and logo -->

    </header>
    <!-- ================================================== END HEADER ================================================== -->


<!-- ================================================== HEADER ================================================== -->
