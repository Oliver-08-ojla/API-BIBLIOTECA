<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
   

    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function store(Request $request)
    {
        $valiData = $request->validate([
            'nombre' => 'required|string|max:255|min:2|regex:/^[\pL\s]+$/u',
            'apellido' => 'required|max:255|min:2|regex:/^[\pL\s]+$/u',
            'cedula' => 'required|numeric|digits:10|unique:clientes',
            'correo' => 'required|email|unique:clientes',
            'telefono' => 'required|numeric|digits:9|unique:clientes',
        ]);

        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'correo' => $request->correo,
            'telefono' => $request->telefono

        ]);
        return response()->json([
            'message' => 'Registrado'
        ]);
    }

    public function show($id)
    {
        $clientes = Cliente::find($id);
        return response()->json([
            'Clientes' => $clientes
        ]);
    }
    public function update(Request $request,  $id)
    {
        $clientes = Cliente::find($id);
        $clientes->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'correo' => $request->correo,
            'telefono' => $request->telefono

        ]);
        return response()->json([
            'message' => 'Actualizado'
        ]);
    }

    public function destroy($id)
    {
        $clientes = Cliente::find($id)->delete();
        return response()->json([
            'message' => 'Eliminado'
        ]);
    }
}
