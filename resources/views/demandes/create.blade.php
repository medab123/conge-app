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
        <div class="card-header">{{ __('Ajouter une demande') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('demandes.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <div class=" px-2 py-2 mb-2 ">
                    <div class="row">
                        
                        <div class="form-group col-6">
                            <label for="client">{{ __('Date de debut') }}</label>
                            <input type="date" placeholder="dd-mm-yyyy"  class="form-control form-control-sm" name="date_debut" id="dt_start" onchange="calc()"  required >
                        </div>
                        <div class="form-group col-6">
                            <label for="client">{{ __('Temps') }}</label>
                            <select name="date_debut_type" class="form-control form-control-sm" id="start_type" onchange="calc()">
                                <option value="Morning" selected="">Matin</option>
                                <option value="Afternoon">Après-midi</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="commercial">{{ __('Date de fin') }}</label>
                            <input type="date"  placeholder="dd-mm-yyyy" class="form-control form-control-sm " name="date_fin" id="dt_end" onchange="calc()" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="client">{{ __('Temps') }}</label>
                            <select name="date_fin_type" class="form-control form-control-sm" id="end_type" onchange="calc()">
                                <option value="Morning">Matin</option>
                                <option value="Afternoon" selected="">Après-midi</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="date_reception">{{ __('Cause (optionnelle)') }}</label>
                            <textarea class="form-control form-control-sm"  name="raison" rows="3"></textarea>
                        </div>
                        <div class="form-group col">
                            <label for="quantite">{{ __('Durée') }}</label>
                            <input type="text" class="form-control form-control-sm disabled" disabled id="duree">
                        </div>

                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 offset-md-5 text-center">
                        <button type="submit" class="btn btn-warning">{{ __('Enregistrer') }}</button>
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

<script>
    //dt_start,dt_end,start_type,end_type
    async function calc () { 
        $("#duree").val("loading ..")
        var dt_start = $("#dt_start").val();
        var dt_end = $("#dt_end").val()
        var start_type = $("#start_type").val()
        var end_type = $("#end_type").val()
        res = await $.get("/demandes/calc_duration/"+dt_start+"/"+dt_end+"/"+start_type+"/"+end_type).then(res => {
            return res;
        }).fail(()=>{
            $("#duree").val("")
        })
        $("#duree").val(res)
        console.log(res);       
    }
    async function getCredit(){
        $("#credit").val("loading ..")
        var type = $("#type").val();
        res = await $.get("/credit/getCredit/"+type).then(res => {
            return res;
        }).fail(()=>{
            $("#credit").val("")
        })
        $("#credit").val('('+res+')')
        console.log(res);   
    }
</script>
@endsection
