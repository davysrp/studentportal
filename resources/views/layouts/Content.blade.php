<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@yield('title')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{url('admin.index')}}">HOME</a>
                        </li>

                        @for($i = 2; $i <= count(Request::segments()); $i++)
                            <li class="breadcrumb-item">
                                <a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">
                                    {{strtoupper(Request::segment($i))}}
                                </a>
                            </li>
                        @endfor
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <span class="fa fa-check"></span>
                    {!! session('success') !!}

                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
        @endif

        @yield('content')
        @hasSection('table')
            <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@yield('card-title')</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <a href="@yield('create-route')" class="btn btn-success"><i class="fa fa-plus"></i> Add
                                    new</a>
                            </div>
                        </div>

                        <div class="table-responsive">

                            @yield('table')
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        Footer
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
        @endif
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
