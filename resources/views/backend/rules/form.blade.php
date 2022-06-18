
@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
            {!! Form::label('slug') !!}
            {!! Form::text('slug',null,['class'=>'form-control']) !!}
            {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>



@foreach($permissions as $permission)
    <?php
    $count = 0;
    if (isset($rule))
        $count = \Illuminate\Support\Facades\DB::table('roles_permissions')->where('permission_id',$permission->id)->where('role_id',$rule->id)->count();
    ?>

<div class="form-group clearfix">
    <div class="icheck-primary d-inline">
        <input type="checkbox" id="{!! $permission->id !!}" name="permission_ids[]" value="{!! $permission->id !!}" @if($count>0) checked @endif>
        <label for="{!! $permission->id !!}">
           {!! $permission->name !!}
        </label>
    </div>
</div>


@endforeach
@section('validation')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#_form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    slug: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: "Please enter a name",
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
           /* $('form').ajaxForm({
                success:function() {
                    $('form').resetForm();
                }
            })*/


        });
    </script>
@endsection
