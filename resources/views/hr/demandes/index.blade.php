@extends('layouts.app')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card " style=" background-color: rgb(255, 255, 255)">
        <div class="card-header d-inline ">{{ __('Demandes Management') }}

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm ">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center  text-nowrap">#</th>
                            <th class="text-center  text-nowrap">Employer</th>
                            <th class="text-center  text-nowrap">Date début</th>
                            <th class="text-center  text-nowrap">Date fin </th>
                            <th class="text-center  text-nowrap">Cause</th>
                            <th class="text-center  text-nowrap">Durée</th>
                            <!--<th class="text-center  text-nowrap">Type</th>-->
                            <th class="text-center  text-nowrap">Statu</th>
                            <th class="text-center  text-nowrap">Demandée le</th>
                            <th class="text-center  text-nowrap">Modifiée le</th>

                            <th class="text-right pr-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($demandes as $demande)
                            <tr>
                                <td class="text-center text-nowrap fw-lighter">{{ $demande->id }}</td>
                                <td class="text-center text-nowrap fw-lighter">{{ $demande->demandeur->name }} {{ $demande->demandeur->last_name }}</td>
                                <td class="text-center text-nowrap fw-lighter">
                                    {{ $demande->date_debut }}({{ $demande->date_debut_type }})</td>
                                <td class="text-center text-nowrap fw-lighter">
                                    {{ $demande->date_fin }}({{ $demande->date_fin_type }})</td>
                                <td class="text-center text-nowrap fw-lighter">{{ $demande->raison }}</td>
                                <td class="text-center text-nowrap fw-lighter">{{ $demande->duration }}</td>

                                <td class="text-center text-nowrap fw-lighter"><span
                                        class="badge  {{ $demande->status <= 1 ? 'badge-warning' : ($demande->status == 2 ? 'badge-success' : 'badge-danger') }}">{{ $demande->status == 0 ? 'En cour' : ($demande->status == 1 ? 'Accepte' : ($demande->status == 2 ? 'Validé' : 'refusé')) }}</span>
                                </td>
                                <td class="text-center text-nowrap fw-lighter">{{ $demande->created_at }}</td>
                                <td class="text-center text-nowrap fw-lighter">{{ $demande->updated_at }}</td>
                                <td class="text-right text-nowrap fw-lighter">


                                    @can('demande-validat')
                                        @if ($demande->status <= 1)
                                            <a href="{{ route('hr.demandes.validat', ['id' => $demande->id]) }}"
                                                class="btn  btn-sm"><i class="fa fa-check text-success" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    @endcan
                                    @can('demande-rejete')
                                        @if ($demande->status <= 1)
                                            <a href="{{ route('hr.demandes.rejete', ['id' => $demande->id]) }}"
                                                class="btn  btn-sm"><i class="fa fa-times text-danger" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    @endcan
                                    @can('demande-delete')
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['demandes.destroy', $demande->id],
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
