<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Historico</th>
            <th scope="col">Criação</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historicos as $historico)
            <tr>
                <td>{{ $historico->historico }}</td>
                <td>{{ date('d/m/Y', strtotime($historico->criacao)) }}</td>
            </tr>
        @endforeach

    </tbody>
</table>

