<?php Carbon\Carbon::setLocale('fr'); ?> 
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/animate/animate.css') }}" rel="stylesheet">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-blue.min.css') }}">

    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <!-- Notifications -->
    <script src="{{ asset('vendor/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('layouts.main_header')

    @include('layouts.main_sidebar')

    <div id="content-wrapper">
        @yield('content')
    </div>

    @include('layouts.main_footer')

    @include('layouts.control_sidebar')

    </div>
    <!-- /#wrapper -->

    <script type="text/javascript">
        $(document).ready(function(){
            var url = window.location;
            var link = $('ul.sidebar-menu li a').filter(function() {
                return this.href == url;
            }).parent().addClass("active");
            while(link.parent().hasClass("treeview-menu")){
                link.parent().addClass("menu-open");
                link.parent().css('display','block');
                link = link.parent().parent();
                link.addClass("active");
            }
            $(".pagination").addClass("pagination-sm no-margin");
        });
    </script>

    @include ('errors.list') {{-- Including error file --}}
    @include ('layouts.message') {{-- Including message file --}}

</body>

</html>
