@extends('layouts.app')

@section('content')
<h2>API</h2>
<p><code>{{ url("/api/poll/{$pwd}") }}</code> – получить сообщение и пометить показанным</p>
<p><code>{{ url("/api/poll/{$pwd}/0") }}</code> – получить сообщение и не помечать показанным</p>
<p><code>{{ url("/api/ack/__ID__/{$pwd}") }}</code> – пометить сообщение показанным</p>
<p><code>{{ url("/announcer-app") }}/</code> – <a href="{{ url("/announcer-app") }}/">виджет OBS</a></p>
@endsection
