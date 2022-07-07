<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}">
            {!! Form::label("type") !!}
            {!! Form::select("type",[
                        'text'=>'Text',
                        'number'=>'Number',
                        'textarea'=>'Textarea',
                        'file'=>'Image',
                        'select'=>'Select',
                        ],null,["class"=>"form-control"]) !!}
            {!! $errors->first("type", '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}">
            {!! Form::label("name") !!}
            {!! Form::text("name",null,["class"=>"form-control"]) !!}
            {!! $errors->first("name", '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has("code") ? "has-error" : "" }}">
            {!! Form::label("code") !!}
            {!! Form::text("code",null,["class"=>"form-control"]) !!}
            {!! $errors->first("code", '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has("is_required") ? "has-error" : "" }}">
            {!! Form::label("is_required") !!}
            {!! Form::select("is_required",['1'=>'Yes','0'=>'No'],null,["class"=>"form-control"]) !!}
            {!! $errors->first("is_required", '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>@section('validation')
    <script>
        $(document).ready(function () {
            $('#_form').validate({
                rules: {
                    type: {
                        required: true,
                    }, name: {
                        required: true,
                    }, is_required: {
                        required: true,
                    }

                },
                messages: {
                    type: {
                        required: "Please enter value in field  Type",
                    },
                    name: {
                        required: "Please enter value in field  Name",
                    },
                    is_required: {
                        required: "Please enter value in field  Is Required",
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
