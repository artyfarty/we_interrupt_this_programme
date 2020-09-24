<div class="box box-info padding-1">
    <div class="box-body">
        {{--<div class="form-group">
            {{ Form::label('program_event_id') }}
            {{ Form::text('program_event_id', $notification->program_event_id, ['class' => 'form-control' . ($errors->has('program_event_id') ? ' is-invalid' : ''), 'placeholder' => 'Program Event Id']) }}
            {!! $errors->first('program_event_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('donation_id') }}
            {{ Form::text('donation_id', $notification->donation_id, ['class' => 'form-control' . ($errors->has('donation_id') ? ' is-invalid' : ''), 'placeholder' => 'Donation Id']) }}
            {!! $errors->first('donation_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>--}}
        <div class="row">
            <div class="col">
                <div class="form-group">
                    {{ Form::label('Тип') }}
                    {{ Form::select('type', ["default" => "Обычное", "urgent" => "Важное", "schedule" => "Расписание", "donation" => "Донат", "list" => "Длинное"], $notification->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : '')]) }}
                    {!! $errors->first('type', '<div class="invalid-feedback">:message</p>') !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {{ Form::label('Приоритет (чем меньше тем он выше)') }}
                    {{ Form::text('priority', $notification->priority, ['class' => 'form-control' . ($errors->has('priority') ? ' is-invalid' : ''), 'placeholder' => 'Priority']) }}
                    {!! $errors->first('priority', '<div class="invalid-feedback">:message</p>') !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {{ Form::label('Сколько раз можно показывать (максимум)') }}
                    {{ Form::text('display_limit', $notification->display_limit, ['class' => 'form-control' . ($errors->has('display_limit') ? ' is-invalid' : ''), 'placeholder' => 'Display Limit']) }}
                    {!! $errors->first('display_limit', '<div class="invalid-feedback">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    {{ Form::label('Надпись (верхняя)') }}
                    {{ Form::text('caption', $notification->caption, ['class' => 'form-control' . ($errors->has('caption') ? ' is-invalid' : ''), 'placeholder' => 'Caption']) }}
                    {!! $errors->first('caption', '<div class="invalid-feedback">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <div class="form-group">
                    {{ Form::label('Заголовок') }}
                    {{ Form::text('headline', $notification->headline, ['class' => 'form-control' . ($errors->has('headline') ? ' is-invalid' : ''), 'placeholder' => 'Headline']) }}
                    {!! $errors->first('headline', '<div class="invalid-feedback">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('Текст сообщения') }}
            {{ Form::textarea('text', $notification->text, ['class' => 'form-control' . ($errors->has('text') ? ' is-invalid' : ''), 'placeholder' => 'Text']) }}
            {!! $errors->first('text', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    {{ Form::label('Показывать начиная с') }}
                    <input type="datetime-local" name="display_from" id="display_from" class="{{ 'form-control' . ($errors->has('display_from') ? ' is-invalid' : '') }}" value="{{ html5date($notification->display_from) }}">
                    {!! $errors->first('display_from', '<div class="invalid-feedback">:message</p>') !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {{ Form::label('Показать до') }}
                    <input type="datetime-local" name="display_till" id="display_till" class="{{ 'form-control' . ($errors->has('display_till') ? ' is-invalid' : '') }}" value="{{ html5date($notification->display_till ?? "+1hour") }}">
                    {!! $errors->first('display_till', '<div class="invalid-feedback">:message</p>') !!}
                </div>
            </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
