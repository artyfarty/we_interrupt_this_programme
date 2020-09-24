@foreach($notification->queued as $queue_entry)
    <p>
        {{ veryshortdatetime($queue_entry->display_at) }}
        @if ($queue_entry->was_displayed)
            <span class="badge badge-success">Показано</span>
        @else
            <span class="badge">Не показано</span>
        @endif
    </p>
@endforeach

