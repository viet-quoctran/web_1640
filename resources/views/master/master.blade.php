<!DOCTYPE html>
<html>
<head>
<title>NewsFeed</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/font.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/li-scroller.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/jquery.fancybox.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../assets/css/style.css') }}">
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  @include('master.header')
  @yield('content')
  @include('master.footer')
</div>
<script src="{{ asset('../assets/js/jquery.min.js') }}"></script> 
<script src="{{ asset('../assets/js/wow.min.js') }}"></script> 
<script src="{{ asset('../assets/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('../assets/js/slick.min.js') }}"></script> 
<script src="{{ asset('../assets/js/jquery.li-scroller.1.0.js') }}"></script> 
<script src="{{ asset('../assets/js/jquery.newsTicker.min.js') }}"></script> 
<script src="{{ asset('../assets/js/jquery.fancybox.pack.js') }}"></script> 
<script src="{{ asset('../assets/js/custom.js') }}"></script>
</body>
</html>