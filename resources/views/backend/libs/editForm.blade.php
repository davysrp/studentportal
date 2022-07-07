<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Header</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        {!! Form::model($model, [ 'route' => [$route, $model->id], 'method' => 'put','enctype'=>'multipart/form-data' ,'files'=>true]) !!}
        @include($form_path)
        <div class="row">
            <div class="col-md-12">
                {!! Form::reset('Reset',['class'=>'btn btn-default']) !!}
                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
