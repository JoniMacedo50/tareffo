@extends('layout')


@section('titulo')
    Empresas
@endsection

@section('conteudo')
    <form name="formFilter" id="formFilter">
        @csrf
        <div class="row">
            <div class="col-3">
                <label>Empresa</label>
                <input type="text" name="nome" id="nome" class="form-control" placeholder="Telefone">
            </div>
            <div class="col-3">
                <label>Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control telefone" placeholder="Telefone">
            </div>
            <div class="col-2">
                <div class="btn-group">
                    <input type="hidden" id="page" name="page" value="0">
                    <button type="submit" class="btn btn-primary me-2 mt-4">Pesquisar</button>
                    <a href="/tareffo/cadastrarEmpresa" class="btn btn-success mt-4 ">Cadastrar</a>
                </div>
            </div>
        </div>
    </form>
    <hr>
    <div class="" id="grid">
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
<script>
    $(document).ready(function() {
        carregaTabela();

        var behavior = function(val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            options = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }
            };

        $('.telefone').mask(behavior, options);

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
            url: "{{ route('empresas.filtrar') }}",
            method: 'GET',
            data: dados,
        }).done(function(data) {
            $('#grid').html(data);
            $("#grid").hide().html(data).fadeIn('slow');
        });

    }
</script>
