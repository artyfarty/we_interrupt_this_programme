@extends('layouts.app')

@section('content')
    <p>У нас тут {{ date_create()->format("Y-m-d H:i:s") }}</p>
    <p>Очередь упихиваем с интервалом в {{ $queue_interval_min }} ~ {{ $queue_interval }} секунд.</p>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">qid&nbsp;/&nbsp;nid</th>
            <th scope="col">Запланировано</th>
            <th scope="col">Показано?</th>
            <th scope="col">Сообщение</th>
            <th scope="col">Параметры показа</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($queues as $entry)
            <tr class="{{ $entry->was_displayed ? "table-secondary" : "" }}">
                <th scope="row">{{ $entry->id }}&nbsp;/&nbsp;{{ $entry->notification_id }}</th>
                <td>{{ veryshortdatetime($entry->display_at) }}</td>
                <td>
                    <form action="{{ route('queue-entries.toggle', $entry->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-trash"></i>{{ $entry->was_displayed ? "Да" : "Нет" }}</button>
                    </form>
                </td>
                <td>
                    @include('partials.notification_content', ["notification" => $entry->notification])
                </td>
                <td>
                    <p>Приоритет: {{ $entry->notification->priority }}</p>
                    <p>Таймфрейм: {{ veryshortdatetime($entry->notification->display_from) }} – {{ veryshortdatetime($entry->notification->display_till) }}</p>
                    <p>Лимит показов: {{ $entry->notification->display_limit }}</p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
