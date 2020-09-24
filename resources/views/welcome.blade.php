@extends('layouts.app')

@section('content')
    <h1>У нас тут не хуй собачий а админка</h1>

    <h2>Запустил? Ну ебать ты сообразителен.</h2>
    <p>Для начала не будь ебалаем, пропиши свои <code>WITP_USERNAME</code>, <code>WITP_EMAIL</code> и <code>WITP_PASSWORD</code>  в <code>.env</code></p>
    <p>А затем перенаполни базу с их учетом <code>php artisan migrate:fresh --seed</code></p>
    <p>Если страница похожа на говно без стилей то сделвй <code>npm run dev</code></p>

    <h2>API</h2>
    <p><code>{{ url('/api/poll/WITP_PASSWORD') }}</code> – получить сообщение и пометить показанным</p>
    <p><code>{{ url('/api/poll/WITP_PASSWORD/0') }}</code> – получить сообщение и не помечать показанным</p>
    <p><code>{{ url('/api/ack/__ID__/WITP_PASSWORD') }}</code> – пометить сообщение показанным</p>
@endsection
