@extends('layout')


@section('titulo')
    Inicio
@endsection

@section('conteudo')
    <div class="row">
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Atenção</h5>
                    <p class="card-text">Você tem um total de <strong>{{$tarefas}}</strong> tarefas atrasadas e não concluídas</p>
                    <a href="#" class="btn btn-primary">Ir</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Título do card</h5>
                    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o
                        conteúdo do card.</p>
                    <a href="#" class="btn btn-primary">Visitar</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Título do card</h5>
                    <p class="card-text">Um exemplo de texto rápido para construir o título do card e fazer preencher o
                        conteúdo do card.</p>
                    <a href="#" class="btn btn-primary">Visitar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
