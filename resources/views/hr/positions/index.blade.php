@extends('layouts.app')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card " style=" background-color: rgb(255, 255, 255)">
        <div class="card-header d-inline ">{{ __('Positions Management') }}
            @can('resource-create')
                <a class="btn btn-success btn-sm float-right d-inline" href="{{ route('hr.positions.create') }}">Create New
                    position</a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm ">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center  text-nowrap">#</th>
                            <th class="text-center  text-nowrap">Nom</th>
                            
                            
                            <th class="text-center  text-nowrap">Crée le</th>
                            <th class="text-center  text-nowrap">Modifiée le</th>

                            <th class="text-right pr-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $position)
                            <tr>
                                <td class="text-center text-nowrap fw-lighter">{{ $position->id }}</td>
                              
                                <td class="text-center text-nowrap fw-lighter">{{ $position->name }}</td>
                                <td class="text-center text-nowrap fw-lighter"><small>{{ $position->created_at }}</small></td>
                                <td class="text-center text-nowrap fw-lighter"><small>{{ $position->updated_at }}</small></td>
                                <td class="text-right text-nowrap fw-lighter">
                                    @can('resource-delete')
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['hr.positions.destroy', $position->id],
                                            'style' => 'display:inline',
                                        ]) !!}
                                        <button type="submit" class="btn  btn-sm"><i class="fa fa-trash text-danger "
                                                aria-hidden="true"></i></button>
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
