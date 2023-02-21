@extends('layouts.app')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card " style=" background-color: rgb(255, 255, 255)">
        <div class="card-header d-inline ">{{ __('Roles Management') }}
            @can('role-create')
                <a class="btn btn-success btn-sm float-right d-inline" href="{{ route('roles.create') }}">Create New role</a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm ">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center  text-nowrap">No</th>
                            <th class="text-center  text-nowrap">Name</th>
                            <th class="text-center  text-nowrap" width="280px">Action</th>
                        </tr>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td class="text-center text-nowrap">{{ ++$i }}</td>
                                <td class="text-center text-nowrap">{{ $role->name }}</td>
                                <td class="text-center text-nowrap">
                                    <a class="btn  btn-sm" href="{{ route('roles.show', $role->id) }}"><i
                                            class="fa fa-eye text-info" aria-hidden="true"></i></a>
                                    @can('role-edit')
                                        <a class="btn btn-sm" href="{{ route('roles.edit', $role->id) }}"><i
                                                class="fa text-primary fa-edit"></i></a>
                                    @endcan
                                    @can('role-delete')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                        <button type="submit" class="btn  btn-sm"><i class="fa fa-trash text-danger "
                                                aria-hidden="true"></i></button>
                                        {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>


    {!! $roles->render() !!}
@endsection
