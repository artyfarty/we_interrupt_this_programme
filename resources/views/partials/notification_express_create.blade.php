
<form method="POST" action="{{ route('notifications.store') }}"  role="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="display_limit" value="1">
    <input type="hidden" name="priority" value="0">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ Form::select('type', ["default" => "Обычное", "urgent" => "Важное", "list" => "Длинное"], null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <input type="text" name="caption" placeholder="Надпись (верхняя)"  class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <input type="text" name="headline" placeholder="Заголовок"  class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <textarea name="text" placeholder="Сообщение" rows="3"  class="form-control"></textarea>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary btn-warning">Срочно в эфир!</button>
    </div>

</form>
