@extends('layouts.app')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card " style=" background-color: rgb(255, 255, 255)">
        <div class="card-header d-inline ">{{ __('List des employes') }}
            @can('user-create')
                <a class="btn btn-success btn-sm float-right d-inline" href="{{ route('users.create') }}">Create new employe</a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive" style="min-height: 300px">
                <table class="table table-striped table-sm ">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center  text-nowrap">#</th>
                            <th class="text-center  text-nowrap">Nom</th>
                            <th class="text-center  text-nowrap">Prenom</th>
                            <th class="text-center  text-nowrap">E-mail</th>
                            <th class="text-center  text-nowrap">Contrat</th>
                            <th class="text-center  text-nowrap">Manager</th>
                            <th class="text-center  text-nowrap">Cin</th>
                            <th class="text-center  text-nowrap">Date d'embauche</th>
                            <th class="text-center  text-nowrap">position</th>

                            <th class="text-right pr-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employes as $employe)
                            <tr>
                                <td class="text-center text-nowrap">{{ $employe->id }}</td>
                                <td class="text-center text-nowrap">{{ $employe->name }}</td>
                                <td class="text-center text-nowrap">{{ $employe->lname }}</td>
                                <td class="text-center text-nowrap">{{ $employe->email }}</td>
                                <td class="text-center text-nowrap">{{ $employe->contrat->name }}</td>
                                <td class="text-center text-nowrap">{{ $employe->manager }}</td>

                                <td class="text-center text-nowrap">{{ $employe->cin }}</td>
                                <td class="text-center text-nowrap">{{ $employe->contrat_date }}</td>
                                <td class="text-center text-nowrap">{{ $employe->position->name }}</td>

                                <td class="text-right text-nowrap">
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-sm " type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('hr.demandes.employer',$employe->id) }}">List Des conges</a>
                                            <a class="dropdown-item" href="{{ route('users.edit',$employe->id) }}">Modifier l'employer</a>
                                            <a class="dropdown-item" href="{{ route('hr.demandes.create',$employe->id) }}">Créer demande d'absence</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
