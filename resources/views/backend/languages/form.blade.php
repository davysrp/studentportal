<div class="row"> <div class="col-md-6">
                        <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}">
                            {!! Form::label("name") !!}
                            {!! Form::text("name",null,["class"=>"form-control"]) !!}
                            {!! $errors->first("name", '<p class="help-block">:message</p>') !!}
                        </div>
                </div> <div class="col-md-6">
                        <div class="form-group {{ $errors->has("code") ? "has-error" : "" }}">
                            {!! Form::label("code") !!}
                            {!! Form::text("code",null,["class"=>"form-control"]) !!}
                            {!! $errors->first("code", '<p class="help-block">:message</p>') !!}
                        </div>
                </div></div><div class="row"></div>@section('validation')
    <script>
        $(document).ready(function () {
            $('#_form').validate({
                rules: {
                    name: {
                        required: true,
                    },code: {
                        required: true,
                    }

                },
                messages: {
                    name: {
                        required: "Please enter value in field  Name",
                    },
code: {
                        required: "Please enter value in field  Code",
                    },
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
        });
    </script>
@endsection
