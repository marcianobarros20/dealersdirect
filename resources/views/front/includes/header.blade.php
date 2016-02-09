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
        <!-- <div class="call-us">
              <p> <span class="icon-phone"></span>080.444.333.233</p>
            </div> -->
        <!-- .call us --> 
        
        <!-- social -->
        <div class="social">
              <ul class="clearfix">
            <!-- <li> <a href="#" class="tip-below success" data-tip="google plus"> <span class="icon-google-plus"></span> </a> </li>
            <li> <a href="#" class="tip-below success" data-tip="facebook"> <span class="icon-facebook"></span> </a> </li>
            <li> <a href="#" class="tip-below success" data-tip="twitter"> <span class="icon-twitter"></span> </a> </li>
            <li> <a href="#" class="tip-below success" data-tip="vimeo"> <span class="icon-vimeo"></span> </a> </li> -->
            <?php if($client!=0){ ?>
            <li> <a href="{!!  url('/') !!}/client-dashboard" class="tip-below success" data-tip="Dashboard"> <span class="icon-dashboard"></span> </a> </li>
            <li> <a href="{!!  url('/') !!}/client_sign_out" class="tip-below success" data-tip="Log Out"> <span class="icon-exit"></span> </a> </li>
            <?php }else{?>
            <li> <a href="{!!  url('/') !!}/client-signin" class="tip-below success" data-tip="Log In"> <span class="icon-switch"></span> </a> </li>
            <?php } ?>
          </ul>
            </div>
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
        <div class="logo"> <a href="<?php echo url('/');?>"> <img src="<?php echo url('/');?>/public/front/images/logonew.png" title="DealersDirect" alt="DealersDirect" /> </a> </div>
        <!-- .logo --> 
        
        <!-- navigation -->
        <nav> 
              
              <!-- navigation wrap -->
              <div class="main-nav"> 
            
            <!-- navigation search -->
            <!-- <div class="nav-search">
                  <form method="post" action="#">
                <fieldset>
                      <span class="icon-search"></span>
                      <input type="text" value="Type term and hit enter..." onfocus="if(this.value=='Type term and hit enter...'){this.value=''}" onblur="if(this.value==''){this.value='Type term and hit enter...'}" />
                    </fieldset>
              </form>
                </div> -->
            <!-- .navigation search --> 
            
            <!-- main navigation -->
            <ul class="main-navigation">
                  
                  <!-- home -->
                  <li><a href="<?php echo url('/');?>" class="active">Home</a></li>
                  <!-- .home --> 
                  <li><a href="" class="active">About</a></li>
                  <li><a href="" class="active">Services</a></li>
                  <li><a href="" class="active">Contact Us</a></li>
                  
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
