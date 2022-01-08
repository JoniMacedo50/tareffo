@extends('layout')


@section('titulo')
    Usuarios
@endsection

@section('conteudo')
<form name="formFilter" id="formFilter">
    <div class="row">
        <div class="col-3">
            <label>Nome completo</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome completo">
        </div>
        <div class="col-3">
            <div class="btn-group">
                <input type="hidden" id="page" name="page" value="0">
                <button type="submit" class="btn btn-primary me-2 mt-4">Pesquisar</button>
                <a href="/tareffo/cadastrarUsuario" class="btn btn-success mt-4 ">Cadastrar</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="" id="grid">
    </div>
</form>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        carregaTabela();

    })
    $(document).on('click', '.paginacao a', function(event) {
        event.preventDefault();
        let pagina = $(this).attr('href').split('page=')[1];
        carregaTabela(pagina);
    })
    $(document).on('submit', '#formFilter', function(event) {
        event.preventDefault();
        carregaTabela();
    })

    function carregaTabela(pagina) {
        $('#page').val(pagina);
        let dados = $('#formFilter').serialize();

        $.ajax({
            url: "{{ route('usuarios.filtrar') }}",
            method: 'GET',
            data: dados,
        }).done(function(data) {
            $('#grid').html(data);
            $("#grid").hide().html(data).fadeIn('slow');
        });

    }
</script>
