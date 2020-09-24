@if ($queue_item)
    <div class="alert alert-info" role="alert">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>
                        Следующее сообщение #{{ $queue_item->id  }} {{ veryshortdatetime($queue_item->display_at) }}
                    </h5>
                    @include('partials.notification_content', ["notification" => $queue_item->notification])
                </div>
                <div class="col">
                    <form action="{{ route('queue-entries.toggle-to', [$queue_item->id, 1]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning"><i class="fa fa-fw fa-trash"></i>Пропустить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    
@endif
