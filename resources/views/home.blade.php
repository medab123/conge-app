@extends('layouts.app')

@section('content')
    <div class="card " style=" background-color: rgb(255, 255, 255)">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-12">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ ($employers) }}</h3>
                            <p>Employes</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-12">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ ($demandes) }}</h3>
                            <p>Demandes</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-12">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ ($soldes) }}</h3>
                            <p>Solde</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
