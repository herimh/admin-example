<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Starter</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap.min.css") }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset("/bower_components/components-font-awesome/css/font-awesome.min.css")  }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset("/bower_components/ionicons/css/ionicons.min.css")  }}">

        <!-- Bootstrap Date Picker -->
        <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/datepicker/datepicker3.css") }}">

        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/daterangepicker/daterangepicker-bs3.css") }}">

        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/iCheck/all.css") }}">

        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/select2/select2.min.css") }}">

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css") }}">

        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="{{asset("/bower_components/admin-lte/dist/css/skins/skin-red-light.min.css")}} ">
        <link rel="stylesheet" href="{{asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}} ">

        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{asset("/bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}} ">

        <link rel="stylesheet" href="{{ asset("/css/admin_app.css") }} ">

        <link rel="stylesheet" href="{{ asset("/bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css") }} ">
        <link rel="stylesheet" href="{{ asset("/bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.css") }} ">

        @yield('css')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]> -->
        <script src="{{ asset("/bower_components/respond/dest/respond.min.js") }}"></script>
        <![endif]-->

    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            @include('vendor.base_admin._header')

            <!-- Left side column. contains the logo and sidebar -->
            @include('vendor.base_admin._sidebar_left')

            <!-- Content Wrapper. Contains page content -->
            @include('vendor.base_admin._content')
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            @include('vendor.base_admin._footer')

            <!-- Control Sidebar -->
            @include('vendor.base_admin._sidebar_right')
            <!-- /.control-sidebar -->

        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="{{asset("bower_components/admin-lte/plugins/jQuery/jQuery-2.2.3.min.js") }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{asset("bower_components/admin-lte/bootstrap/js/bootstrap.min.js") }}"> </script>
        <!-- AdminLTE App -->
        <script src="{{asset("bower_components/admin-lte/dist/js/app.min.js")}}"></script>
        <!-- Select2 -->
        <script src="{{ asset("/bower_components/admin-lte/plugins/select2/select2.full.min.js") }}"></script>
        <script src="{{ asset("/bower_components/admin-lte/plugins/select2/i18n/es.js") }}"></script>
        <!-- Date picker -->
        <script src="{{ asset("/bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
        <script src="{{ asset("/bower_components/admin-lte/plugins/datepicker/locales/bootstrap-datepicker.es.js") }}"></script>
        <script src="{{ asset("/bower_components/moment/min/moment.min.js") }}"></script>
        <script src="{{ asset("/bower_components/moment/locale/es.js") }}"></script>
        <script src="{{ asset("/bower_components/admin-lte/plugins/daterangepicker/daterangepicker.js") }}"></script>
        <script src="{{ asset("/bower_components/admin-lte/plugins/iCheck/icheck.min.js") }}"></script>
        <!-- bootstrap wysihtml5 - text editor -->
        <script src="{{asset("/bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}} "></script>
        <script src="{{asset("/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js")}} "></script>
        <script src="{{ asset("/bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.js") }}"></script>
        <script src="{{ asset("/bower_components/vue/dist/vue.min.js") }}"></script>

        <!-- JS App para Admin -->
        <script src="{{ asset("/js/admin_app.js") }}"></script>

        @yield('javascript')

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
    </body>
</html>
