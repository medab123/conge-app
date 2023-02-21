
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
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



{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">


        <div class="form-group">
            <strong>Nom:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Nom','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            <strong>Prenom:</strong>
            {!! Form::text('Prenom', null, array('placeholder' => 'Prenom','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            <strong>CIN:</strong>
            {!! Form::text('CIN', null, array('placeholder' => 'CIN','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            <strong>Date naissance :</strong>
            {!! Form::date('Date_naissance', null, array('placeholder' => 'date naissance','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            <strong>Adresse :</strong>
            {!! Form::text('Adresse', null, array('placeholder' => 'Adresse','class' => 'form-control')) !!}
        </div>


        <div class="form-group">
            <strong>Ville :</strong>
            {!! Form::text('Ville', null, array('placeholder' => 'Ville','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            <strong>CNSS :</strong>
            {!! Form::text('CNSS', null, array('placeholder' => 'CNSS','class' => 'form-control')) !!}
        </div>


        <div class="form-group">
            <strong>Solde   :</strong>
            {!! Form::text('Solde', null, array('placeholder' => 'Solde','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            <strong>Solde Global  :</strong>
            {!! Form::text('Solde_Global', null, array('placeholder' => 'SoldeG','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            <strong>Salire  :</strong>
            {!! Form::text('Salire', null, array('placeholder' => 'Salire','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            <strong>Date contrat   :</strong>
            {!! Form::date('Date_contrat', null, array('placeholder' => 'Date contrat','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            <strong>Projet   :</strong>
            {!! Form::text('Projet', null, array('placeholder' => 'Projet','class' => 'form-control')) !!}
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

@endsection

