<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public $rules= [

        'nombre'=>'required|string|max:255|min:2|regex:/^[\pL\s]+$/u',
        'apellido'=>'required|max:255|min:2|regex:/^[\pL\s]+$/u',
        'cedula'=>'required|numeric|digits:10|unique:clientes',
        'correo'=>'required|email|unique:clientes',
        'telefono'=>'required|numeric|digits:10|unique:clientes',


    ];


    public $messages=[

        'nombre.required' => 'Se requiere el nombre del cliente',
        'nombre.regex' => 'Solo letras',
        'nombre.max' => 'Excedio el maximo de caracteres',
        'nombre.min' => 'El nombre tiene que tener minimo 2 caracteres',
        'apellido.required' => 'Se requiere el apellido del cliente',
        'apellido.regex' => 'Solo letras',
        'apellido.max' => 'Excedio el maximo de caracteres',
        'apellido.min' => 'El apellido tiene que tener minimo 2 caracteres',
        'cedula.required' => 'Se requiere la cedula del cliente',
        'cedula.numeric' => 'Solo se permiten numero',
        'cedula.digits' => 'Solo se permiten 10 numeros',
        'cedula.unique' => 'No debe de existir dos numeros de cedula iguales',
        'correo.required' => 'Se requiere el correo electronico del cliente',
        'correo.email' => 'Se requiere el correo electronico del cliente en formato email',
        'correo.unique' => 'No deben de existir dos direcciones de correo electronico iguales',
        'telefono.required' => 'Se requiere numero telefonico del cliente',
        'telefono.numeric' => 'Solo se permiten numeros',
        'telefono.digits' => 'Solo se permiten 10 numeros',
        'telefono.unique' => 'No deben de existir dos numeros de cedula iguales',


        
    ];

    public function index()
    {
        $clientes = Cliente::all();
        return response()->json([
            'Clientes'=>$clientes
        ]);

    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),$this->rules,$this->messages);
        if($validator -> fails()){
            $messages=$validator->getMessageBag();
            return response()->json([
                'messages'=>$messages
            ],500);
        }

        $cliente =Cliente::create([
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'cedula'=>$request->cedula,
            'correo'=>$request->correo,
            'telefono'=>$request->telefono

       ]);
       return response()->json([
           'messages'=>'Se creo con exito.'
       ]);

    }
 
    public function show($id)
    {
        $clientes = Cliente::find($id);
        return response()->json([
            'Clientes'=>$clientes
        ]);

    }
    public function update(Request $request,  $id)
    {
        $clientes = Cliente::find($id);
        $clientes->update([
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'cedula'=>$request->cedula,
            'correo'=>$request->correo,
            'telefono'=>$request->telefono

        ]);
        return response()->json([
            'messages'=>'Se Modifico con exito.'
        ]);

    }

    public function destroy( $id)
    {
        $clientes = Cliente::find($id)->delete();
        return response()->json([
            'messages'=>'Se Elimino con exito.'
        ]);

    }

}
