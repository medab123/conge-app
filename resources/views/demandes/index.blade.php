@extends('layouts.app')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card " style=" background-color: rgb(255, 255, 255)">
        <div class="card-header d-inline ">{{ __('Demandes Management') }}
            @can('user-create')
                <a class="btn btn-success btn-sm float-right d-inline" href="{{ route('demandes.create') }}">Create New Demande</a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm ">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center  text-nowrap">#</th>
                            <th class="text-center  text-nowrap">Name</th>
                            <th class="text-center  text-nowrap">Email</th>
                            <th class="text-center  text-nowrap">Roles</th>
                            <th class="text-center  text-nowrap">Active</th>

                            <th class="text-right pr-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($demandes as $demande)
                            <tr>
                                <td class="text-center text-nowrap">{{ $demande->id }}</td>
                                <td class="text-center text-nowrap">{{ $demande->name }}</td>
                                <td class="text-center text-nowrap">{{ $demande->email }}</td>

                                <td class="text-center text-nowrap">
                                    @if (!empty($demande->getRoleNames()))
                                        @foreach ($demande->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-center text-nowrap"><label
                                        class="badge badge-{{ $demande->is_active == true ? 'success' : 'danger' }}">{{ $demande->is_active == true ? 'Active' : 'Desactiver' }}</label>
                                </td>

                                <td class="text-right text-nowrap">

                                    <a class="btn  btn-sm" href="{{ route('demandes.show', $demande->id) }}"><i
                                            class="fa fa-eye text-info" aria-hidden="true"></i></a>
                                    @can('user-edit')
                                        <a class="btn  btn-sm" href="{{ route('demandes.edit', $demande->id) }}"><i
                                                class="fa text-primary fa-edit"></i></a>
                                    @endcan
                                    @can('user-delete')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['demandes.destroy', $demande->id], 'style' => 'display:inline']) !!}
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
