@extends('layouts.app')

@section('template_title')
    {{ $programEvent->name ?? 'Show Program Event' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Program Event</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('program-events.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Begin At:</strong>
                            {{ $programEvent->begin_at }}
                        </div>
                        <div class="form-group">
                            <strong>Headline:</strong>
                            {{ $programEvent->headline }}
                        </div>
                        <div class="form-group">
                            <strong>Text:</strong>
                            {{ $programEvent->text }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $programEvent->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
