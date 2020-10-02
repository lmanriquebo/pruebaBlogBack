<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Genera la consulta de todos los posts
        $Posts = Post::with(['author'])->get();

        //Recorre los posts para asignar la ruta a la imagen
        foreach ($Posts as $id => $data) {
            $Posts[$id]['image'] =  url(\Storage::url($data['image']));
        }

        //Retorna posts
        return response()->json(
        	["message" => $Posts],
        	200
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Valida los datos a ingresar
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required',
            'image' => 'required',
            'author_id' => 'required|numeric'
        ]);

        //Retorna los errores
        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->first(),
            ], 401);
        }

        //Almacena la imagen
        $name = time().'.'.'jpg';
        $img = base64_decode(explode(",",$request->get('image'))[1]);
        Storage::put("public/{$name}", $img);

        //Registra el dato
        $Post = new Post();
        $Post->title = $request->get('title');
        $Post->content = $request->get('content');
        $Post->image = $name;
        $Post->author_id = $request->get('author_id');
        $Post->save();

        //Retorna resultado
        return response()->json(
        	["message" => "Post {$request->get('title')} creado exitosamente."],
        	200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Post = Post::whereId($id)->with(['author'])->get();
        $Post[0]['image'] =  url(\Storage::url($Post[0]['image']));

        return response()->json(
        	["message" => $Post],
        	200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required',
            'image' => 'required',
            'author_id' => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->first(),
            ], 401);
        }

        $img = Post::whereId($id)->value('image');

        Storage::delete("public/{$img}");

        $name = time().'.'.'jpg';
        $dataImage = base64_decode(explode(",",$request->get('image'))[1]);
        Storage::put("public/{$name}", $dataImage);


        $Post = Post::find($id);
        $Post->title = $request->get('title');
        $Post->content = $request->get('content');
        $Post->image = $name;
        $Post->author_id = $request->get('author_id');
        $Post->save();

        return response()->json(
        	["message" => "Post {$request->get('title')} actualizado exitosamente."],
        	200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::whereId($id)->delete();

        return response()->json(
        	["message" => "El post fue eliminado exitosamente."],
        	200
        );
    }
}
