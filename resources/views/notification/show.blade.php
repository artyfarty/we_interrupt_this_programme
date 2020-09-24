@extends('layouts.app')

@section('template_title')
    {{ $notification->name ?? 'Show Notification' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Notification</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('notifications.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Program Event Id:</strong>
                            {{ $notification->program_event_id }}
                        </div>
                        <div class="form-group">
                            <strong>Donation Id:</strong>
                            {{ $notification->donation_id }}
                        </div>
                        <div class="form-group">
                            <strong>Caption:</strong>
                            {{ $notification->caption }}
                        </div>
                        <div class="form-group">
                            <strong>Headline:</strong>
                            {{ $notification->headline }}
                        </div>
                        <div class="form-group">
                            <strong>Text:</strong>
                            {{ $notification->text }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $notification->type }}
                        </div>
                        <div class="form-group">
                            <strong>Meta:</strong>
                            {{ json_encode($notification->meta) }}
                        </div>
                        <div class="form-group">
                            <strong>Priority:</strong>
                            {{ $notification->priority }}
                        </div>
                        <div class="form-group">
                            <strong>Display Limit:</strong>
                            {{ $notification->display_limit }}
                        </div>
                        <div class="form-group">
                            <strong>Display From:</strong>
                            {{ $notification->display_from }}
                        </div>
                        <div class="form-group">
                            <strong>Display Till:</strong>
                            {{ $notification->display_till }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
