<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}">
            {!! Form::label("name") !!}
            {!! Form::text("name",null,["class"=>"form-control"]) !!}
            {!! $errors->first("name", '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has("slug") ? "has-error" : "" }}">
            {!! Form::label("slug") !!}
            {!! Form::text("slug",null,["class"=>"form-control"]) !!}
            {!! $errors->first("slug", '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has("attribute_set_id") ? "has-error" : "" }}">
            {!! Form::label("attribute_set_id") !!}
            {!! Form::select("attribute_set_id",$attributeSet,null,["class"=>"form-control"]) !!}
            {!! $errors->first("attribute_set_id", '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
@section('validation')
    <script>
        $(document).ready(function () {
            $('#_form').validate({
                rules: {
                    name: {
                        required: true,
                    }, slug: {
                        required: true,
                    }, attribute_set_id: {
                        required: true,
                    }

                },
                messages: {
                    name: {
                        required: "Please enter value in field  Name",
                    },
                    slug: {
                        required: "Please enter value in field  Slug",
                    },
                    attribute_set_id: {
                        required: "Please enter value in field  Attribute Set Id",
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
