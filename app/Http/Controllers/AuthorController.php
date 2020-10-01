<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Authors = Author::with(['posts'])->get();

        return response()->json(
        	["message" => $Authors],
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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->first(),
            ], 401);
        }

        $Author = new Author();
        $Author->first_name = $request->get('first_name');
        $Author->last_name = $request->get('last_name');
        $Author->save();

        return response()->json(
        	["message" => "Autor {$request->get('first_name')} {$request->get('last_name')} creado exitosamente."],
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

        $Author = Author::whereId($id)->with(['posts'])->get();

        return response()->json(
        	["message" => $Author],
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
            'first_name' => 'required|string',
            'last_name' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->first(),
            ], 401);
        }

        $Author = Author::find($id);
        $Author->first_name = $request->get('first_name');
        $Author->last_name = $request->get('last_name');
        $Author->save();

        return response()->json(
        	["message" => "Autor {$request->get('first_name')} {$request->get('last_name')} actualizado exitosamente."],
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
        Author::whereId($id)->delete();

        return response()->json(
        	["message" => "El autor fue eliminado exitosamente."],
        	200
        );
    }
}
