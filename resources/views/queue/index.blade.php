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
            <tr>
                <th scope="row">{{ $entry->id }}&nbsp;/&nbsp;{{ $entry->notification_id }}</th>
                <td>{{ date_create($entry->display_at)->format("j M H:i") }}</td>
                <td>{{ $entry->was_displayed ? "Да" : "Нет" }}</td>
                <td>
                    <p>
                        <span class="badge badge-info">{{ $entry->notification->type }}</span>
                    </p>
                    <h4>{{ $entry->notification->caption }}</h4>
                    <h5>{{ $entry->notification->headline }}</h5>
                    {{ $entry->notification->text }}
                </td>
                <td>
                    <p>Приоритет: {{ $entry->notification->priority }}</p>
                    <p>Таймфрейм: {{ date_create($entry->notification->display_from)->format("j M H:i") }} – {{ date_create($entry->notification->display_till)->format("j M H:i") }}</p>
                    <p>Лимит показов: {{ $entry->notification->display_limit }}</p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
