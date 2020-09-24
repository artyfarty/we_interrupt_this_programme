@extends('layouts.app')

@section('content')
    <p>Последний раз обновлено {{ date_create()->format("Y-m-d H:i:s") }}</p>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Донатер</th>
            <th scope="col">Скока</th>
            <th scope="col">Сообщение</th>
            <th scope="col">Модерация</th>
            <th scope="col">Очередь?</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($donations as $donate)
            <tr class="">
                <th scope="row">{{ $donate->person }}</th>
                <td>{{ $donate->sum }} {{ $donate->currency }}</td>
                <td>
                    @if($donate->notification)
                        @include('partials.notification_content', ["notification" => $donate->notification])
                    @else
                        {{ $donate->message }}
                    @endif
                </td>
                <td>
                    <form action="{{ route('donations.toggle', $donate->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-trash"></i>{{ $donate->approved ? "Разрешен" : "Запрещен" }}</button>
                    </form>
                </td>
                <td>
                    @if($donate->notification)
                        @include('partials.queue_status', ["notification" => $donate->notification])
                    @else
                        Не в очереди
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
