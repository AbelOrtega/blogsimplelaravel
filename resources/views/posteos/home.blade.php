@extends('..layouts.app')

@section('content')
<section class="w-full bg-gray-200 py-4 flex-row justify-center text-center">
    <h2 class="py-4 text-3xl">Acerca de  mi creación</h2>
    <div class="flex text-justify justify-center">
        <div class="max-w-5xl px-2">
            Hola es mi primer BLOG
        </div>
    </div>
</section>
<section class="w-full">
    <div class="flex justify-center">
        <div class="max-w-6xl text-center">
            <h2 class="py-4 text-3xl border-solid border-gray-300 border-b-2">Posteos del Blog</h2>
            <div class="flex flex-wrap justify-between">
                @foreach($posteos as $posteo)
                <article style="width:300px" class="text-left p-2">
                    <h3 class="py-4 text-xl">{{$posteo->titulo}}</h3>
                    <p>{{$posteo->contenido}} <a class="font-bold text-blue-600 no-underline hover:underline" href="{{ route('posteos.detalle', $posteo->id) }}">mas detalles</a></p>
                </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection