<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js st-ie6" lang=""> <![endif]-->
<!--[if IE 7]> <html class="no-js st-ie7" lang=""> <![endif]-->
<!--[if IE 8]> <html class="no-js st-ie8" lang=""> <![endif]-->
<!--[if IE 9]> <html class="no-js st-ie9" lang=""> <![endif]-->
<!--[if gt IE 9]> <html class="no-js lang=""> <![endif]-->
<!--[if lt IE 9]>
 <script src="/js/html5shiv.js" type="text/javascript"></script>
 <script src="/js/respond.min.js" type="text/javascript"></script>
<![endif]-->
<html lang="en">
@include('front.section_includes.head')
<body class="homepage">
@include('front.section_includes.header')
@yield('content')

@include('front.section_includes.footer')
@include('front.section_includes.footdealer')
</body>
</html>