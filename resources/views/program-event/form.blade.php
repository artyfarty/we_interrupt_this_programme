<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('begin_at') }}
            <input type="datetime-local" name="begin_at" id="begin_at" class="{{ 'form-control' . ($errors->has('begin_at') ? ' is-invalid' : '') }}" value="{{ html5date($programEvent->begin_at) }}">
            {!! $errors->first('begin_at', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('headline') }}
            {{ Form::text('headline', $programEvent->headline, ['class' => 'form-control' . ($errors->has('headline') ? ' is-invalid' : ''), 'placeholder' => 'Headline']) }}
            {!! $errors->first('headline', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('text') }}
            {{ Form::text('text', $programEvent->text, ['class' => 'form-control' . ($errors->has('text') ? ' is-invalid' : ''), 'placeholder' => 'Text']) }}
            {!! $errors->first('text', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::select('status', ["enabled" => "Вкл", "disabled" => "Выкл"], $programEvent->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : '')]) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
