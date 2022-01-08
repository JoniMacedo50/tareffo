@extends('layout')

@section('titulo')
    @if (isset($tarefa))Editar tarefa @else Cadastrar tarefa @endif
@endsection

@section('conteudo')
    @if (isset($tarefa))<form method="" id="formEdit" action="{{ url("/tareffo/$tarefa->id/tarefa") }}"> @method('PUT') @else <form method="POST" id="formCreate"> @endif

    @csrf
    <div class="row">
        <div class="col-4">
            <label>Solicitante</label>
            <input type="text" class="form-control" name="solicitante" required placeholder="Solicitante"
                value="{{ $tarefa->solicitante ?? '' }}">
        </div>
        <div class="col-2">
            <label>Empresa</label>
            <select name="empresa" class="form-control">
                <option value=""></option>
                @foreach ($empresas as $empresa)
                    <option @if (isset($tarefa)) @if ($tarefa->empresas_id == $empresa->id) selected @endif @endif value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <label>Tipo</label>
            <select class="form-control" name="tipo">
                <option value=""></option>
                <option value="E" @if (isset($tarefa))@if ($tarefa->tipo == 'E')selected @endif @endif>Erro</option>
                <option value="D" @if (isset($tarefa))@if ($tarefa->tipo == 'D')selected @endif @endif>Desenvolvimento</option>
            </select>
        </div>
        <div class="col-2">
            <label>Prioridade</label>
            <select name="prioridade" id="prioridade" class="form-control">
                <option value=""></option>
                <option value="B" @if (isset($tarefa))@if ($tarefa->prioridade == 'B')selected @endif @endif>Baixa</option>
                <option value="M" @if (isset($tarefa))@if ($tarefa->prioridade == 'M')selected @endif @endif>Média</option>
                <option value="A" @if (isset($tarefa))@if ($tarefa->prioridade == 'A')selected @endif @endif>Alta</option>
            </select>
        </div>
        <div class="col-4">
            <label>Solicitação</label>
            <textarea class="form-control" name="solicitacao" style="height: 100px" required placeholder="Soliciação"
            >{{ $tarefa->solicitacao ?? '' }}</textarea>
        </div>
        @if (isset($tarefa))

            <div class="col-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="AV" @if ($tarefa->status == 'AV') selected @endif>Em processo de avaliação</option>
                    <option value="AP" @if ($tarefa->status == 'AP') selected @endif>Aprovado</option>
                    <option value="DE" @if ($tarefa->status == 'DE') selected @endif>Em processo de desenvolvimento</option>
                    <option value="CL" @if ($tarefa->status == 'CL') selected @endif>Concluido</option>
                    <option value="NG" @if ($tarefa->status == 'NG') selected @endif>Negado</option>
                </select>
            </div>
        @else
            <input type="hidden" name="status" value="AV">
        @endif
        @if (isset($tarefa))
            <div class="col-3">
                <label>Previsão</label>
                <input type="date" class="form-control" name="previsao" placeholder="Previsão"
                    value="{{ $tarefa->previsao ?? '' }}">
            </div>
        @endif
    </div>
    <div class="col-2">
        <div class="btn-group">
            <a href="/tareffo/listarTarefas" class="btn btn-primary mt-4 me-2">Voltar</a> <br>
            <button class="btn btn-success mt-4">@if (isset($tarefa)) Editar @else Cadastrar @endif</button>
        </div>
    </div>

    </form>
@endsection
