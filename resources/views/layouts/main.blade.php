<!DOCTYPE html>
<html lang="en">

<!-- doccure/profile-settings.html  30 Nov 2019 04:12:18 GMT -->

<head>
    <meta charset="utf-8">
    <title>Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Favicons -->
    <link href="{{asset('img/favicon.png')}}" rel="icon">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    @stack('css')

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('css/dstyle.css')}}">

    <!-- HTML5 shim and Respond.js')}} IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
			<script src="/js/html5shiv.min.js')}}"></script>
			<script src="/js/respond.min.js')}}"></script>
		<![endif]-->

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        


        @yield('content')


    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{asset('js/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- Select2 JS -->
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- Sticky Sidebar JS -->
    <script src="{{asset('plugins/theia-sticky-sidebar/ResizeSensor.js')}}"></script>
    <script src="{{asset('plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{asset('js/script.js')}}"></script>

    @stack('js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 JS -->
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>

    <!-- Dropzone JS -->
    <script src="{{asset('plugins/dropzone/dropzone.min.js')}}"></script>

    <!-- Bootstrap Tagsinput JS -->
    <script src="{{asset('plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>

    <!-- Profile Settings JS -->
    <script src="{{asset('js/profile-settings.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{asset('js/script.js')}}"></script>


</body>

<!-- doccure/profile-settings.html  30 Nov 2019 04:12:18 GMT -->

</html>