@extends('..layouts.app')

@section('content')
<section class="w-full bg-gray-200 py-4 flex-row justify-center text-center">
    <div class="flex justify-center">
        <div class="max-w-4xl">
            <h1 class="px-4 text-6xl break-words">{{$posteo->titulo}}</h1>
        </div>
    </div>
</section>
<article class="w-full py-8">
    <div class="flex justify-center">
        <div class="max-w-4xl text-justify">
            {{$posteo->contenido}}
        </div>
    </div>
</article>
<section class="w-full py-8">
    <div class="max-w-4xl flex-row justify-start p-3 text-left ml-auto mr-auto border rounded shadow-sm bg-gray-50">
        <h3 class="py-4 text-2xl">Comentarios</h3>
        @guest
        <p>Si estas logueado puedes escribir comentarios</p>
        @else
        <form action="{{ route('comentarios.store') }}" method="post">
            @csrf
            <textarea class="w-full h-28 resize-none border rounded focus:outline-none focus:shadow-outline p-2" name="comentario" placeholder="Escribe tu comentario" required>{{ old('comentario') }}</textarea>
            <input type="hidden" name="post_id" value="{{$posteo->id}}">
            <input type="submit" value="SEND" class="px-4 py-2 bg-orange-300 cursor-pointer hover:bg-orange-500 font-bold w-full border rounded border-orange-300 hover:border-orange-500 text-white">
            @if (session('status'))
                <div class="w-full bg-green-500 p-2 text-center my-2 text-white">
                    {{ session('status') }}
                </div>
            @endif
            @if($errors->any())
            <div class="w-full bg-red-500 p-2 text-center my-2 text-white">
                {{$errors->first()}}
            </div>
            @endif
        </form>
        @endguest
        <div>
            @foreach($posteo->comentarios as $comentario)
            <div class="w-full bg-white p-2 my-2 border">
                <div class="header flex justify-between mb-4 text-sm text-gray-500">
                    <div>
                        By {{$comentario->user->name}}
                    </div>
                    <div>
                        {{$comentario->created_at->format('j F, Y')}}
                    </div>
                </div>
                <div class="text-lg">{{$comentario->comentario}}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection