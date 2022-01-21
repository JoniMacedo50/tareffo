<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>Login</title>

</head>

<body class="fundo">
    <div class="d-flex justify-content-center" id="imgpos">
        <form action="{{route('valida.login')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label"><strong>Usuário</strong></label>
                <input type="text" class="form-control" id="user" name="usuario" required autofocus>
            </div>
            <div class="mb-3">
                <label for="" class="form-label"><strong>Senha</strong></label>
                <input type="password" class="form-control" id="password" name="senha" required autocomplete="current-password">
            </div>
            @if (Session::get('msg'))
            <div class="mb-3 alert alert-danger"">
                {{Session::get('msg')}}
                </div>
            @endif
            <button type="submit" class="btn btn-dark">Entrar</button>
        </form>
    </div>
</body>

</html>
