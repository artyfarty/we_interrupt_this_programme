@extends('layouts.app')

@section('template_title')
    Config
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Config') }}
                            </span>

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
										<th></th>
										<th>Value</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($configs as $config)
                                        <tr>
											<td>
                                                <h5>{{ $config->key }}</h5>
                                                <p>{{ $config->desc }}</p>
                                            </td>
											<td>{{ $config->value }}</td>

                                            <td>
                                                <form action="{{ route('configs.destroy',$config->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('configs.edit',$config->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $configs->links() !!}
            </div>
        </div>
    </div>
@endsection
