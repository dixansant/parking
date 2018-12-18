@extends('layouts.scene')
@section('content_scene')
    <div class="row">
        <h1>Mis alquileres</h1>
        @php($mis = \App\Alquiler::where('usuario',auth()->user()->id)->get())
        @foreach($mis as $alq)
            <h4> <b>{{ $alq->nombre }}</b> &nbsp; &nbsp; &nbsp; <a href="{{ route('aditar.alquiler',['alquiler'=>$alq->id]) }}">Editar</a></h4>
            <p>{{ $alq->descripcion}}</p>
        @endforeach
    </div>
@endsection
