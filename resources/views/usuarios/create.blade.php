@extends('layout')

@section('titulo')
    @if(isset($tarefa))Editar usuário @else Cadastrar usuário @endif
@endsection

@section('conteudo')
@if(isset($usuario))<form method="" id="formEdit" action="{{url("/tareffo/$usuario->id/usuario")}}"> @method('PUT') @else <form method="POST" id="formCreate"> @endif
    <form method="POST" method="{{ route('cadastra.usuario') }}">
        @csrf
        <div class="form-group">
            <div class="col-3">
                <label>Nome completo</label>
                <input type="text" class="form-control" name="nomeCompleto" placeholder="Nome completo" value="{{ $usuario->nome_completo ?? ''}}">
            </div>
            <div class="col-3">
                <label>Nome de usuário</label>
                <input type="text" class="form-control" name="nomeUsuario" placeholder="Nome de usuário" value="{{ $usuario->nome ?? ''}}">
            </div>
            <div class="col-2">
                <label>Senha</label>
                <input type="password" class="form-control" name="senha" placeholder="Senha" value="******" required>
            </div>
            <br>
            <div class="col-2">
                <div class="btn-group">
                    <a href="/tareffo/listaUsuarios" class="btn btn-primary mt-4 me-2">Voltar</a> <br>
                    <button class="btn btn-success mt-4">@if(isset($tarefa)) Editar @else Cadastrar @endif</button>
                </div>
                </div>
        </div>
    </form>
@endsection
