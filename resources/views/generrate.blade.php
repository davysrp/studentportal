@php
    $getFields = [];
$i=1;
@endphp
<div class="row">
    @foreach($fields as $field)
        @if ($field!='id' && $field!='created_at' && $field!='updated_at' && $field!='deleted_at' )
            @php
                $getFields[] = $field;
            @endphp
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label($field) !!}
                    {!! Form::text($field,null,['class'=>'form-control']) !!}
                </div>
            </div>

            @if ($i%2==0)
                </div>
                <div class="row">
            @endif
                    @php( $i++ )
        @endif
    @endforeach
</div>
