@extends('..layouts.app')

@section('content')
<section class="w-full bg-gray-200 py-4 flex-row justify-center text-center">
    <div class="flex justify-center">
        <div class="max-w-4xl">
            <h1 class="px-4 text-6xl break-words">Lista de Posteos</h1>
        </div>
    </div>
</section>
<article class="w-full py-8">
    <div class="flex justify-center">
        <div class="max-w-7xl text-justify">@if($errors->any())
            <div class="w-full bg-red-500 p-2 text-center my-2 text-white">
                {{$errors->first()}}
            </div>
            @endif
            @if (session('status'))
                <div class="w-full bg-green-500 p-2 text-center my-2 text-white">
                    {{ session('status') }}
                </div>
            @endif
            <div class="text-right py-2">
                
            </div>
            <table class="table-auto">
                <thead>
                    <tr>
                        <th class="px-2">Titulo</th>
                        <th class="px-2">Creado el</th>
                        <th class="px-2">Autor</th>
                        <th class="px-2">Editar</th>
                        <th class="px-2">Borrar</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($posteos as $posteo)
                    <tr>
                        <td class="px-2">{{ $posteo->titulo }}</td>
                        <td class="px-2">{{ $posteo->created_at->format('j F, Y') }}</td>
                        <td class="px-2">{{ $posteo->users_id }}</td>
                        <td class="px-2">
                            
                        </td>
                        
                        </td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</article>
<script>

    var delete_post_action = document.getElementsByClassName("delete-post");

    var deleteAction = function(e) {
        event.preventDefault();
        var id = this.dataset.id;
        if(confirm('Are you sure?')) {
            document.getElementById('posts.destroy-form-' + id).submit();
        }
        return false;
    }

    for (var i = 0; i < delete_post_action.length; i++) {
        delete_post_action[i].addEventListener('click', deleteAction, false);
    }
</script>
@endsection