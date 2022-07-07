{{--<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}">
            {!! Form::label("name") !!}
            {!! Form::text("name",null,["class"=>"form-control"]) !!}
            {!! $errors->first("name", '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>--}}

<?php
$languages = \App\Models\Language::orderBy('id','DESC')->get();

    ?>

@foreach($languages as $value)
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}">
                {!! Form::label("code",$value->name) !!}
                {!! Form::text("code[]",$value->code,["class"=>"form-control",'readonly']) !!}
                {!! Form::hidden("language_id[]",$value->id,["class"=>"form-control",'readonly']) !!}
                {!! $errors->first("code", '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}">
                {!! Form::label($value->name." name") !!}
                @if($label)
                    {!! Form::text("name[]",\App\Models\LabelValue::where('language_id',$value->id)->where('label_id',$label->id)->first()->value,["class"=>"form-control"]) !!}
                @else
                    {!! Form::text("name[]",null,["class"=>"form-control"]) !!}
                @endif
                {!! $errors->first("name", '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>


@endforeach

@section('validation')
    <script>
        $(document).ready(function () {
            $('#_form').validate({
                rules: {
                    name: {
                        required: true,
                    }

                },
                messages: {
                    name: {
                        required: "Please enter value in field  Name",
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
