<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="navbar-collapse custom-content-header">
        <div class="navbar-left">
            @section('content-breadcrumbs')
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i  class="fa fa-dashboard"></i>{{ trans('label.dashboard') }}</a></li>
            </ol>
            @show
        </div>

        @yield('content-actions')
        <!-- COPY THIS EXAMPLE TO ADD PAGE ACTIONS

            <ul class="nav navbar-nav navbar-right">
                <li><a  href="/admin/app/commerce-product/create" style=" ">
                        <i class="fa fa-plus-circle"></i> Add new</a></li>
            </ul>

        -->

    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @yield('content')
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div><!-- /.content-wrapper -->