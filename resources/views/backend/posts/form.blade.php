
<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}">
            {!! Form::label('name') !!}
            {!! Form::text('name',null,["class"=>"form-control"]) !!}
            {!! Form::hidden('attribute_id',$attributeSetId,["class"=>"form-control"]) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}">
            {!! Form::label('parent_id','Parent') !!}
            {!! Form::select('parent_id',$parent,null,["class"=>"form-control",'placeholder'=>'Select Parent...']) !!}
            {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <?php
            $i = 1;
            $x = 1;
            ?>
            @foreach($languages as $item)
                <li class="nav-item">
                    <a class="nav-link @if($i==1) active @endif " id="custom-tabs-four-home-tab" data-toggle="pill"
                       href="#custom-tabs-four-{!! $item->code !!}" role="tab"
                       aria-controls="custom-tabs-four-{!! $item->code !!}" aria-selected="true">{!! $item->name !!}</a>
                </li>
                @php
                    $i++

                @endphp
            @endforeach

        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            @foreach($languages as $item)
                <div class="tab-pane fade @if($x==1) active @endif show" id="custom-tabs-four-{!! $item->code !!}"
                     role="tabpanel"
                     aria-labelledby="custom-tabs-four-{!! $item->code !!}-tab">
                    {!! Form::hidden('language_id[]',$item->id,["class"=>"form-control"]) !!}

                    <div class="row">

                        @foreach($attribute as $attributeItem)
                            @if($attributeItem->type=='textarea')
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has($attributeItem->slug) ? "has-error" : "" }}">
                                        {!! Form::label('code'.$attributeItem->code,$attributeItem->name) !!}
                                        {!! Form::textarea($attributeItem->code.$item->id,null,["class"=>"form-control",'rows'=>3]) !!}
                                        {!! $errors->first('code'.$attributeItem->code, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            @elseif($attributeItem->type=='text')
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}">
                                        {!! Form::label('code'.$attributeItem->code,$attributeItem->name) !!}
                                        {!! Form::text($attributeItem->code.$item->id,null,["class"=>"form-control"]) !!}
                                        {!! $errors->first('code'.$attributeItem->code, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            @elseif($attributeItem->type=='number')
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has($item->slug) ? "has-error" : "" }}">
                                        {!! Form::label('code'.$attributeItem->code,$attributeItem->name) !!}
                                        {!! Form::number($attributeItem->code.$item->id,null,["class"=>"form-control"]) !!}
                                        {!! $errors->first('code'.$attributeItem->code, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            @endif


                        @endforeach
                    </div>

                </div>

                @php
                    $x++

                @endphp
            @endforeach
        </div>
    </div>
    <!-- /.card -->
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label("thumbnail") !!}
            <div class="input-group">
                <div class="custom-file">
                    {!! Form::file("thumbnail",null,["class"=>"custom-file-input"]) !!}
                    {!! Form::label("thumbnail",'Choose file',['class'=>'custom-file-label']) !!}
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}">
            {!! Form::label("status") !!}
            {!! Form::select("status",['publish'=>'Publish','unpublish'=>'Unpublish','review'=>'Review'],null,["class"=>"form-control"]) !!}
            {!! $errors->first("status", '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label("images") !!}
            <div class="input-group">
                <div class="custom-file">
                    {!! Form::file("images[]",["class"=>"custom-file-input",'multiple']) !!}
                    {!! Form::label("images",'Choose file',['class'=>'custom-file-label']) !!}
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                </div>
            </div>
        </div>
    </div>
</div>

@section('validation')
    <script>
        $(document).ready(function () {
            $('#_form').validate({
                rules: {
                    price: {
                        required: true,
                    }

                },
                messages: {
                    price: {
                        required: "Please enter value in field  price",
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
        });
    </script>
@endsection
@section('js')
    <script src="{!! asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') !!}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>

@endsection
