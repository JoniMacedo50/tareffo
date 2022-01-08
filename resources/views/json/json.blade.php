@extends('layout')

@section('titulo')
    Cadastrar
@endsection
@section('conteudo')

    <form method="POST" name="formStore" id="formStore" action="">
        @csrf
        <div class="form-group">
            <div class="col-3">
                <label>Nome completo</label>
                <input type="text" class="form-control" name="json" placeholder="Nome completo">
            </div>
            <br>
            <div class="col-2">
                <div class="btn-group">
                    <button class="btn btn-success mt-4">Cadastrar</button>
                </div>
            </div>
        </div>
    </form>
    <div id="grid"></div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<script>

$(document).on('submit', '#formStore', function(event) {
        event.preventDefault();
        storeJson();
        $(location).attr('href', 'http://localhost/tareffo/inicio');
    })

function storeJson() {

    let jsonData = $('#formStore').serialize();

    $.ajax({
        url: "{{ route('json.store') }}",
        method: 'POST',
        data: jsonData,
    }).done(function(data) {
        $('#grid').html(data);
        $("#grid").hide().html(data).fadeIn('slow');
    });
}</script>
