<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibroRequest;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class LibroController extends Controller
{


    public $rules = [
        'titulo' => 'required|unique:libros|regex:"^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]+$"',
        'autor' => 'required|regex:"^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]+$"',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];
    public $messages = [
        'titulo.required' => 'El titulo tiene que estar llenado',
        'titulo.unique' => 'El titulo ya esta en uso',
        'titulo.regex' => 'Solo se permiten caracteres validos',

        'autor.required' => 'El autor tiene que estar llenado',
        'autor.regex' => 'Solo se permiten caracteres validos',

        'image.required' => 'Se requiere una imagen',
        'image.image' => 'Solo se permite imagenes',
        'image.mimes' => 'Tipo de imagen no valido',
    ];


    public function index()
    {
        $libros = Libro::all();

        return response()->json([
            'libros' => $libros
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                'message' => $messages
            ], 500);
        }

        $file = request()->file('image');
        $obj = Cloudinary::upload($file->getRealPath(), ['folder' => 'libros']);
        $public_id = $obj->getPublicId();
        $url = $obj->getSecurePath();

        Libro::create([

            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'url_libro' => $url,
            'image_id' => $public_id

        ]);

        return response()->json(['message' => "Registrado"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $libro = Libro::find($id);

        return response()->json([
            'libro' => $libro
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        Libro::find($id)->update($request->all());

        $libro = Libro::find($id);
        $url = $libro->url;
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

        return response()->json([
            'messages' => "Se actualizo correctamente"
        ]);
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
            'messages' => "Se elimino correctamente"
        ]);
    }
}
