@extends('layouts.layout')

@section('content')
    <p>У нас тут {{ date_create()->format("Y-m-d H:i:s") }}</p>
    <p>Очередь упихиваем с минимальным интервалом в {{ $queue_interval }} секунд.</p>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Запланировано</th>
            <th scope="col">Показано?</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($queues as $entry)
            <tr>
                <th scope="row">{{ $entry->id }}</th>
                <td>{{ $entry->display_at->format("j F H:i:s") }}</td>
                <td>{{ $entry->was_displayed ? "Да" : "Нет" }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
