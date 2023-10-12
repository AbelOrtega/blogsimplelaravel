<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComentarioRequest;
use App\Models\Comentario;
use App\Models\Posteo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(ComentarioRequest $request)
    {
        $request->validated();

        $user = Auth::user();
        $posteo = Posteo::find($request->input('posteos_id'));

        $comentario = new Comentario();
        $comentario->comentario = $request->input('comentario');
        $comentario->user()->associate($user);
        $comentario->posteo()->associate($posteo);

        $res = $comentario->save();

        if ($res) {
            return back()->with('status', 'Comment has been created sucessfully');
        }

        return back()->withErrors(['msg', 'There was an error saving the comment, please try again later']);
    }

}
