@extends('layout')

@section('titulo')
    list
@endsection
@section('conteudo')

@foreach ($json as $item)
    <ul>

         {{$item->id}}  
        @foreach ($item->json as $array)
           <li>{{$array}}</li>
        @endforeach

       
        
    </ul>
    @endforeach

    {{$response}}
@endsection
