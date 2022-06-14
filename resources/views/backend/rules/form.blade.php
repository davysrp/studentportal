
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
