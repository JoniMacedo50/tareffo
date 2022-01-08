@extends('layout')

@section('titulo')
    @if (isset($empresa))Editar empresa @else Cadastrar empresa @endif
@endsection

@section('conteudo')
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                    aria-controls="v-pills-home" aria-selected="true">Perfil</a>
                @if (isset($empresa))
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages"
                        role="tab" aria-controls="v-pills-messages" aria-selected="false">Tarefas</a>
                @endif
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    @if (isset($empresa))<form method="" id="formEdit" action="{{ url("/tareffo/$empresa->id/empresa") }}"> @method('PUT') @else <form method="POST" id="formCreate"> @endif
                    @csrf
                    <div class="form-group">
                        <div class="col-2">
                            <label>Empresa</label>
                            <input type="text" class="form-control" name="nome" placeholder="Empresa"
                                value="{{ $empresa->nome ?? '' }}">
                        </div>
                        <div class="col-3">
                            <label>Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone"
                                value="{{ $empresa->telefone ?? '' }}">
                        </div>
                        <div class="col-2">
                            <div class="btn-group">
                                <a href="/tareffo/listaEmpresas" class="btn btn-primary mt-4 me-2">Voltar</a> <br>
                                <button type="submit" class="btn btn-success mt-4">@if (isset($empresa)) Editar @else Cadastrar @endif</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                @if (isset($tarefas))

                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                        aria-labelledby="v-pills-messages-tab">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Solicitante</th>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Prioridade</th>
                                    <th scope="col">Solicitação</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Previsão</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarefas as $tarefa)
                                    <tr>
                                        <td>{{ $tarefa->id }}</td>
                                        <td>{{ $tarefa->solicitante }}</td>
                                        <td>{{ $tarefa->nome }}</td>

                                        @if ($tarefa->tipo == 'E')
                                            <td style="color: #da3243;">Erro</td>
                                        @elseif($tarefa->tipo == "D")
                                            <td style="color: #0d6efd;">Desenvolvimento</td>
                                        @endif

                                        @if ($tarefa->prioridade == 'B')
                                            <td style="color: #0d6efd;">Baixa</td>
                                        @elseif($tarefa->prioridade == "M")
                                            <td style="color: #ffe000;">Média</td>
                                        @elseif($tarefa->prioridade == "A")
                                            <td style="color: #da3243;">Alta</td>
                                        @endif

                                        <td>{{ $tarefa->solicitacao }}</td>

                                        @if ($tarefa->status == 'AV')
                                            <td style="color: #0d6efd;">Em processo de avaliação</td>
                                        @elseif($tarefa->status == "AP")
                                            <td style="color: #5cc7a3;">Aprovado</td>
                                        @elseif($tarefa->status == "DE")
                                            <td style="color: #0d6efd;">Em processo de desenvolvimento</td>
                                        @elseif($tarefa->status == "CL")
                                            <td style="color: #35a370;">Concluido</td>
                                        @elseif($tarefa->status == "NG")
                                            <td style="color: #da3243;">Negado</td>
                                        @endif

                                        <td @if ($tarefa->previsao <= NOW()) style="color: #da3243;"@else style="color: #35a370;" @endif>{{ date('d/m/Y', strtotime($tarefa->previsao)) }}
                                        </td>
                                        @if ($tarefa->conclusao == null)
                                            <td>Não Concluido</td>
                                        @else
                                            <td> {{ date('d/m/Y', strtotime($tarefa->conclusao)) }}</td>
                                        @endif

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                                                        <path
                                                            d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu pb-0 mb-0" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item me-3"
                                                        href="{{ url("/tareffo/{$tarefa->id}/editTarefa") }}">Editar</a>
                                                    <form method="POST" action="/tareffo/deleteTarefa/{{ $tarefa->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="dropdown-item">
                                                            <button type="submit" class="btn btn-link ps-0"
                                                                style="text-decoration: none; color: black;">Remover</button>
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <a href="/tareffo/listaEmpresas" class="btn btn-primary mt-4 me-2">Voltar</a> <br>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<script type='text/javascript' src='//igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js'></script>
<script>
    $(document).ready(function() {

        var behavior = function(val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            options = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }
            };

        $('#telefone').mask(behavior, options);

    })
</script>
