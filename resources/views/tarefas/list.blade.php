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
            <th scope="col">Conclusão</th>
            <!-<th scope="col">Anexos</th>->
            
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tarefas as $tarefa)
            <tr>
                <td>{{ $tarefa->id }}</td>
                <td>{{ $tarefa->solicitante }}</td>
                <td><a style="text-decoration: none;"
                        href="{{ url("/tareffo/{$tarefa->empresasId}/editEmpresa") }}">{{ $tarefa->empresasNome }}</a>
                </td>

                @if ($tarefa->tipo == 'E')
                    <td style="color: #da3243;">Erro</td>
                @elseif($tarefa->tipo == "D")
                    <td>Desenvolvimento</td>
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

                <td @if ($tarefa->previsao <= NOW() && $tarefa->status != 'CL') style="color: #da3243;" @else style="color: #35a370;" @endif>{{ date('d/m/Y', strtotime($tarefa->previsao)) }}</td>
                @if ($tarefa->conclusao == null)
                    <td>Não Concluido</td>
                @else
                    <td> {{ date('d/m/Y', strtotime($tarefa->conclusao)) }}</td>
                @endif

                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-list-task" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                                <path
                                    d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                                <path fill-rule="evenodd"
                                    d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
                            </svg>
                        </button>
                        <div class="dropdown-menu pb-0 mb-0" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item me-3 ps-0" href="#"><button type="button"
                                    class="btn btn-link ps-3 historico" id="historico" value="{{ $tarefa->id }}"
                                    style="text-decoration: none; color: black;">Histórico</button></a>
                            <a class="dropdown-item me-3 ps-0" href="#"><button type="button"
                                    class="btn btn-link ps-3 anexo" id="anexo" value="{{ $tarefa->id }}"
                                    style="text-decoration: none; color: black;">Adicionar anexo</button></a>
                                    <a class="dropdown-item me-3 ps-0" href="#"><button type="button"
                                        class="btn btn-link ps-3 anexoVisualizar" id="anexoVisualizar" value="{{ $tarefa->id }}"
                                        style="text-decoration: none; color: black;">Visualizar anexo</button></a>
                                    <a class="dropdown-item me-3 pt-3 pb-3 whastappWeb" href="https://api.whatsapp.com/send?phone=55{{ $tarefa->empresaTelefone }}&text=Ol%C3%A1%20teste%20sua%20solicita%C3%A7%C3%A3o%20acaba%20de%20ser%20conclu%C3%ADda%2C%20para%20maiores%20detalhes%2C%20entre%20em%20contato%20pelo%20link%20https%3A%2F%2Fapi.whatsapp.com%2Fsend%3Fphone%3D5551992110218%20ou%20pelo%20chat%20interno%20do%20sistema.">Avisar Solicitante</a>
                            <a class="dropdown-item me-3 pt-2 pb-3"
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
<div class="d-flex justify-content-center paginacao">
    {{ $tarefas->links('pagination::bootstrap-4') }}
</div>
