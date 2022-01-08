<?php $i = 1; ?>
@foreach ($anexos as $anexo)

    <a class="btn btn-primary anexoAbrir" href="{{ url("storage/{$anexo->img}") }}">Visualizar Anexo {{ $i }}</a>
    <?php $i++; ?>
@endforeach
