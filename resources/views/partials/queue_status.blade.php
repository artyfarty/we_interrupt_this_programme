@foreach($notification->queued as $queue_entry)
    <p>{{ veryshortdatetime($queue_entry->display_at) }}</p>
@endforeach

