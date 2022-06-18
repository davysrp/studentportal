
@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
            {!! Form::label('firstname') !!}
            {!! Form::text('firstname',null,['class'=>'form-control']) !!}
            {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('lastname') !!}
            {!! Form::text('lastname',null,['class'=>'form-control']) !!}
            {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('phone') !!}
            {!! Form::text('phone',null,['class'=>'form-control']) !!}
            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::text('email',null,['class'=>'form-control']) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('gender') !!}
            {!! Form::select('gender',['Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control']) !!}
            {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('status') !!}
            {!! Form::select('status',['Yes'=>'Yes','No'=>'No'],null,['class'=>'form-control']) !!}
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('role_id','Rule') !!}
            {!! Form::select('role_id',$rules,null,['class'=>'form-control']) !!}
            {!! $errors->first('role_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
@if(!isset($user))
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('password') !!}
            {!! Form::text('password',null,['class'=>'form-control']) !!}
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('confirm_password') !!}
            {!! Form::text('confirm_password',null,['class'=>'form-control']) !!}
            {!! $errors->first('confirm_password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
@endif

@section('validation')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#_form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },

                    confirm_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                    rule_id: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
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
