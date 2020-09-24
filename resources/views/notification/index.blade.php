@extends('layouts.app')

@section('template_title')
    Notification
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Notification') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('notifications.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>С</th>
                                        <th>По</th>
                                        <th>В очереди</th>

										<th>Контент</th>
										<th>Priority</th>
										<th>Display Limit</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $notification)
                                        <tr>
                                            <td>{{ veryshortdatetime($notification->display_from) }}</td>
                                            <td>{{ veryshortdatetime($notification->display_till) }}</td>
                                            <td>
                                                @foreach($notification->queued as $queue_entry)
                                                    <p>{{ veryshortdatetime($queue_entry->display_at) }}</p>
                                                @endforeach
                                            </td>
											<td>
                                                @include('partials.notification_content')
                                            </td>
											<td>{{ $notification->priority }}</td>
											<td>{{ $notification->display_limit }}</td>

                                            <td>
                                                <form action="{{ route('notifications.destroy',$notification->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('notifications.show',$notification->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('notifications.edit',$notification->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $notifications->links() !!}
            </div>
        </div>
    </div>
@endsection
