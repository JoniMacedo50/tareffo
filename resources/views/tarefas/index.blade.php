@extends('layout')


@section('titulo')
    Tarefas
@endsection

@section('conteudo')
    <form name="formFilter" id="formFilter">
        @csrf
        <div class="row">
            <div class="col-2">
                <label>Solicitante</label>
                <input type="text" name="solicitante" id="solicitante" class="form-control" placeholder="solicitante">
            </div>
            <div class="col-2">
                <label>Solicitação</label>
                <input type="text" name="solicitacao" class="form-control" placeholder="Soliciação">
            </div>
            <div class="col-2">
                <label>Empresa</label>
                <select name="empresa" class="form-control">
                    <option value="">Todos</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                    @endforeach
                    <select>
            </div>
            <div class="col-2">
                <label>Tipo</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="">Todos</option>
                    <option value="E">Erro</option>
                    <option value="D">Desenvolvimento</option>
                </select>
            </div>
            <div class="col-2">
                <label>Prioridade</label>
                <select name="prioridade" id="prioridade" class="form-control">
                    <option value="">Todos</option>
                    <option value="B">Baixa</option>
                    <option value="M">Média</option>
                    <option value="A">Alta</option>
                </select>
            </div>
            <div class="col-2">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Todos</option>
                    <option value="AV">Em processo de avaliação</option>
                    <option value="AP">Aprovado</option>
                    <option value="DE">Em processo de desenvolvimento</option>
                    <option value="CL">Concluido</option>
                    <option value="NG">Negado</option>
                </select>
            </div>
            <div class="col-2">
                <label>Previsão</label>
                <input type="date" name="previsao" class="form-control" placeholder="Previsão">
            </div>
            <div class="col-2">
                <label>Situação</label>
                <select name="situacao" class="form-control">
                    <option value="">Todos</option>
                    <option value="A">Atrasados</option>
                    <option value="D">Em dia</option>
                </select>
            </div>
            <div class="col-2">
                <div class="btn-group">
                    <input type="hidden" id="page" name="page" value="0">
                    <button type="submit" class="btn btn-primary me-2 mt-4">Pesquisar</button>
                    <a href="/tareffo/cadastrarTarefa" class="btn btn-success mt-4 ">Cadastrar</a>
                </div>
            </div>
        </div>
    </form>
    <hr>
    @if (Session::get('msgTarefa'))
        <div class="alert alert-success" role="alert">
            <p>{{ Session::get('msgTarefa') }}</p>
            <p>{{ Session::get('msgEmail') }}</p>
        </div>
    @endif
    {{ Session::forget('msgTarefa', 'msgEmail') }}
    @if (Session::get('msgRemoveTarefa'))
        <div class="alert alert-success" role="alert">
            <p>{{ Session::get('msgRemoveTarefa') }}</p>
        </div>
    @endif
    {{ Session::forget('msgRemoveTarefa') }}
    <div class="" id="grid">
    </div>

    <div class="modal fade" id="modalHistorico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Histórico</h5>
                    <button type="button" class="btn-close" id="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="formHistoric" id="formHistoric">
                        @csrf
                        <textarea class="form-control" name="historico" placeholder="Preencha um histórico"
                            id="floatingTextarea2" style="height: 100px"></textarea>
                        <input type="hidden" class="idTarefa" name="idTarefaHistorico">
                        <input type="submit" class="btn btn-success" value="Cadastrar">
                    </form>
                    <form name="formList" id="formList">
                        @csrf
                        <input type="hidden" class="idTarefa" name="idTarefaHistorico">
                    </form>
                    <div id="gridHistorico">
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAnexo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar anexo</h5>
                    <button type="button" class="btn-close" id="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="formAnexo" method="POST" action="{{ route('adicionar.anexo') }}" id="formAnexo"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="anexo" class="form-control">
                        <br>
                        <input type="hidden" class="idTarefaAnexo" name="idTarefaAnexo">
                        <input type="submit" class="btn btn-success" value="Salvar">
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exibeAnexo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Visualizar anexo</h5>
                    <button type="button" class="btn-close" id="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="gridAnexo"></div>
                    <form name="formVisualizaAnexo" method="GET" action="{{ route('exibir.anexo') }}"
                        id="formVisualizaAnexo">
                        @csrf
                        <input type="hidden" class="IdExibeAnexo" name="IdExibeAnexo">
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<script>
    $(document).on('click', '.whastappWeb', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        window.open(url, '_blank');
    });

    $(document).on('click', '.anexoAbrir', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        window.open(url, '_blank');
    });


    $(document).on('click', '#close', function(event) {
        event.preventDefault();
        $('#modalHistorico').modal('hide');
        $('#modalAnexo').modal('hide');
    })

    $(document).on('click', '.historico', function(event) {
        event.preventDefault();
        $('#modalHistorico').modal('show');
        $('.idTarefa').val($(this).val());
        listaHistórico();
    })

    $(document).on('click', '.anexo', function(event) {
        event.preventDefault();
        $('#modalAnexo').modal('show');
        $('.idTarefaAnexo').val($(this).val());

    })

    $(document).on('click', '.anexoVisualizar', function(event) {
        event.preventDefault();
        $('#exibeAnexo').modal('show');
        $('.IdExibeAnexo').val($(this).val());
        listaAnexo();
    })

    $(document).on('submit', '#formHistoric', function(event) {
        event.preventDefault();
        adicionaHistórico()
    })


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
            url: "{{ route('tarefas.filtrar') }}",
            method: 'GET',
            data: dados,
        }).done(function(data) {
            $('#grid').html(data);
            $("#grid").hide().html(data).fadeIn('slow');
        });

    }

    function listaHistórico() {

        let historico = $('#formList').serialize();

        $.ajax({
            url: "{{ route('tarefas.historico') }}",
            method: 'GET',
            data: historico,
        }).done(function(data) {
            $('#gridHistorico').html(data);
            $("#gridHistorico").hide().html(data).fadeIn('slow');
        });
    }

    function listaAnexo() {

        let historico = $('#formVisualizaAnexo').serialize();

        $.ajax({
            url: "{{ route('exibir.anexo') }}",
            method: 'GET',
            data: historico,
        }).done(function(data) {
            $('#gridAnexo').html(data);
            $("#gridAnexo").hide().html(data).fadeIn('slow');
        });
    }

    function adicionaHistórico() {

        let historico = $('#formHistoric').serialize();

        $.ajax({
            url: "{{ route('tarefas.historico') }}",
            method: 'GET',
            data: historico,
        }).done(function() {
            listaHistórico()
        });
    }
</script>
