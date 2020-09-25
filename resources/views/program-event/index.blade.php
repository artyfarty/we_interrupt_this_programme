@extends('layouts.app')

@section('template_title')
    События
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('События') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('program-events.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Добавить') }}
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
										<th>Начало</th>
										<th>Заголовок</th>
										<th>Текст</th>
										<th>Статус</th>
                                        <th>В очереди?</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programEvents as $programEvent)
                                        <tr>
											<td>{{ veryshortdatetime($programEvent->begin_at) }}</td>
											<td>{{ $programEvent->headline }}</td>
											<td>{{ $programEvent->text }}</td>
											<td>
                                                <form action="{{ route('program-events.toggle', $programEvent->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm {{ $programEvent->status == "enabled" ? "btn-success" : "btn-warning" }}">
                                                        <i class="fa fa-fw fa-trash"></i>{{ $programEvent->status == "enabled" ? "Активно" : "Выключено" }}
                                                    </button>
                                                </form>
                                            </td>

                                            <td>
                                                @if($programEvent->notification)
                                                    @include('partials.queue_status', ["notification" => $programEvent->notification])
                                                @else
                                                    Не в очереди
                                                @endif
                                            </td>

                                            <td>
                                                <form action="{{ route('program-events.destroy',$programEvent->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('program-events.edit',$programEvent->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $programEvents->links() !!}
            </div>
        </div>
    </div>
@endsection
