@extends('layouts.app')


@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card " style=" background-color: rgb(255, 255, 255)">
        <div class="card-header d-inline ">{{ __('Types Management') }}
            @can('resource-create')
                <!--<a class="btn btn-success btn-sm float-right d-inline" href="{{ route('hr.types.create') }}">Create New
                            type</a>-->
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm ">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center  text-nowrap">#</th>
                            <th class="text-center  text-nowrap">Nom</th>
                            <th class="text-center  text-nowrap">Period</th>
                            <th class="text-center  text-nowrap">Description</th>
                            <th class="text-center  text-nowrap">Etate</th>
                            <th class="text-right pr-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <td class="text-center text-nowrap fw-lighter">{{ $type->id }}</td>
                                <td class="text-center text-nowrap fw-lighter">{{ $type->name }}</td>
                                <td class="text-center text-nowrap fw-lighter">{{ $type->start_date }}-{{ $type->end_date }}</td>
                                <td class="text-center text-nowrap fw-lighter">{{ $type->description }}</td>
                                <td class="text-center text-nowrap fw-lighter">
                                    <input onchange="te({{ $type->id }},this)" class="checkbox_state" data-size="xs" data-typeid="{{ $type->id }}"
                                        type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive"
                                        data-onstyle="success" data-offstyle="danger" {{ $type->active ? 'checked' : '' }}>
                                </td>
                                <td class="text-right text-nowrap fw-lighter">
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    <script>
        function te(id,el) {
            var action = el.checked ? "activate":"deactivate";
            $.get("/hr/types/"+action+"/"+id)
        }
   
</script>
@endsection
