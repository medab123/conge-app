@extends('layouts.app')


@section('content')



    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">{{ __('Ajouter une projet') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('hr.projets.store') }}" enctype="multipart/form-data">
                @csrf
                <div class=" px-2 py-2 mb-2 ">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>{{ __('Nom de projet') }}</label>
                            <input type="text" class="form-control form-control-sm" name="name" required>
                        </div>
                        <div class="form-group">
                            <strong>Manager:</strong>
                            {!! Form::select('manager_id', $managers,null, ['class' => 'form-control']) !!}
                        </div>

                       
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2 offset-md-5 text-center">
                            <button type="submit" class="btn btn-warning">{{ __('Enregistrer') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection
