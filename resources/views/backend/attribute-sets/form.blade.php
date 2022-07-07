<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}">
            {!! Form::label("name") !!}
            {!! Form::text("name",null,["class"=>"form-control"]) !!}
            {!! $errors->first("name", '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


@foreach($attributes as $attribute)
    <?php
    $count = 0;
    if (isset($attribute_set))
        $count = \Illuminate\Support\Facades\DB::table('attribute_set_attribute')->where('attribute_id',$attribute->id)->where('attribute_set_id',$attribute_set->id)->count();
    ?>

    <div class="form-group clearfix">
        <div class="icheck-primary d-inline">
            <input type="checkbox" id="{!! $attribute->id !!}" name="attributeIds[]" value="{!! $attribute->id !!}" @if($count>0) checked @endif>
            <label for="{!! $attribute->id !!}">
                {!! $attribute->name !!}
            </label>
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
