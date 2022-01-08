<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Empresa</th>
            <th scope="col">Telefone</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empresas as $empresa)
            <tr>
                <td>{{ $empresa->id }}</td>
                <td><a style="text-decoration: none;" href="{{url("/tareffo/{$empresa->id}/editEmpresa")}}">{{ $empresa->nome }}</a></td>
                <td class="telefone">{{ $empresa->telefone }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center paginacao">
    {{ $empresas->links('pagination::bootstrap-4') }}
</div>
