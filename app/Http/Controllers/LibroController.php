<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class LibroController extends Controller
{

    public function index()
    {
        $libros = Libro::all();

        return response()->json($libros);
    }

    public function store(Request $request)
    {
        $validData = $request->validate([
            'titulo' => 'required|unique:libros',
            'autor' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|'
        ]);

        $file = request()->file('image');
        $obj = Cloudinary::upload($file->getRealPath(), ['folder' => 'libros']);
        $public_id = $obj->getPublicId();
        $url = $obj->getSecurePath();
        

        Libro::create([

            'titulo' => $validData['titulo'],
            'autor' => $validData['autor'],
            'url_libro' => $url,
            'image_id' => $public_id

        ]);

        return response()->json(['message' => "Registrado"]);
    }

    public function show($id)
    {
        $libro = Libro::find($id);

        return response()->json([
            'libro' => $libro
        ]);
    }

   
    public function update(Request $request, $id)
    {
        
        Libro::find($id)->update($request->all());
        
        $libro = Libro::find($id);
        
        $url = $libro->url_libro;
        $public_id = $libro->image_id;

        if ($request->hasFile('image')) {
            Cloudinary::destroy($public_id);
            
            $file = request()->file('image');
            $obj = Cloudinary::upload($file->getRealPath(), ['folder' => 'libros']);
            $url = $obj->getSecurePath();
            $public_id = $obj->getPublicId();
        }

        $libro->update([
            "titulo" => $request->titulo,
            "autor" => $request->autor,
            "url_libro" => $url,
            "image_id" => $public_id
        ]); 

        return response()->json(['message'=>'Actualizado'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $libro = Libro::find($id);
        $public_id = $libro->image_id;
        Cloudinary::destroy($public_id);
        Libro::destroy($id);

        return response()->json([
            'message' => "Eliminado"
        ],200);
    }
}
