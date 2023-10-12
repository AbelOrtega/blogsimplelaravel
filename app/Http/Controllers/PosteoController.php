<?php

namespace App\Http\Controllers;

use App\Models\Posteo;
use Illuminate\Http\Request;

use App\Http\Requests\PosteoRequest;
use Illuminate\Support\Facades\Auth;

class PosteoController extends Controller
{
    public function home()
    {        
        $posteos = Posteo::orderBy('created_at', 'desc')->get()->take(6);

        return view('posteos.home',compact('posteos'));
    }

//detail - detalle slug por id
    public function detalle($id)
    {
        $posteo = Posteo::where('id', $id)->first();
        abort_unless($posteo, 404);
        return view('posteos.posteo', [
            'posteo' => $posteo
        ]);
    }


    public function index(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $user = $request->user();

        if (Auth::check()) {
            $posteos = Posteo::orderBy('created_at', 'desc')->get();
        } else {
            abort_unless(Auth::check(), 404);
        }
        return view('posteos.listar', [
            'posteos' => $posteos
        ]);
    }

    //crear por create
    public function crear(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $request->user();
        return view('posteos.crear');
    }

    public function store(PosteoRequest $request)
    {
        $request->validated();
        $user = Auth::user();

        $posteo = new Posteo;
        $posteo->titulo = $request->input('titulo');
        $posteo->contenido = $request->input('contenido');
        $posteo->users()->associate($user);

        $res = $posteo->save();

        if ($res) {
            return back()->with('status', 'El Posteo fue creado satisfactoriamente');
        }

        return back()->withErrors(['msg', 'Ocurrio un error al grabar el posteo, intenta nuevamente']);
    }

    public function show(Posteo $posteo)
    {
      //  return view('posteos.show')->with('posteo', $posteo);
    }

    public function editar(Request $request, $id)
    {
        abort_unless(Auth::check(), 404);

        $posteo = Posteo::find($id);
        if (($posteo->user->id != $request->user()->id)) {
            abort_unless(false, 401);
        }
        return view('posteos.editar', [
            'posteo' => $posteo
        ]);
    }


    public function update(PosteoRequest $request, $id)
    {
        $request->validated();
        $request->user();
        $posteo = Posteo::find($id);
        if (($posteo->user->id != $request->user()->id)) {
            abort_unless(false, 401);
        }

        $posteo->titulo = $request->input('titulo');
        $posteo->contenido = $request->input('contenido');

        $res = $posteo->save();

        if ($res) {
            return back()->with('status', 'El posteo fue actualizado');
        }

        return back()->withErrors(['msg', 'Se produjo un error, intentar nuevamente']);
    }

    public function borrar(Request $request, $id)
    {
        abort_unless(Auth::check(), 404);
        $request->user();
        $posteo = Posteo::where('id', $id)->first();
        if (($posteo->user->id != $request->user()->id)) {
            abort_unless(false, 401);
        }

        $posteo->delete();

        return back()->with('status', 'El posteo fue eliminado');
    }



}
