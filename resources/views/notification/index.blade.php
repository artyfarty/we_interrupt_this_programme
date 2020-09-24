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
                                        <th>No</th>

										<th>Program Event Id</th>
										<th>Donation Id</th>
										<th>Caption</th>
										<th>Headline</th>
										<th>Text</th>
										<th>Type</th>
										<th>Meta</th>
										<th>Priority</th>
										<th>Display Limit</th>
										<th>Display From</th>
										<th>Display Till</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $notification)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $notification->program_event_id }}</td>
											<td>{{ $notification->donation_id }}</td>
											<td>{{ $notification->caption }}</td>
											<td>{{ $notification->headline }}</td>
											<td>{{ $notification->text }}</td>
											<td>{{ $notification->type }}</td>
											<td>{{ json_encode($notification->meta) }}</td>
											<td>{{ $notification->priority }}</td>
											<td>{{ $notification->display_limit }}</td>
											<td>{{ $notification->display_from }}</td>
											<td>{{ $notification->display_till }}</td>

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
