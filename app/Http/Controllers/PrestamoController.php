<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PrestamoController extends Controller
{

    /*  public $rulesPrestamo=[
        'fechaPrestamo' => 'required|date_format:Y-m-d',
        'fechaDevolucion' => 'required|date_format:Y-m-d|after:fechaPrestamo',
        'fechaRealDevolucion' => 'date_format:Y-m-d|after_or_equal:fechaDevolucion'

    ];
    public $messagesU=[
        'fechaPrestamo.required'=>'Se requiere fecha de prestamo',
        'fechaPrestamo.dato_format'=>'La fecha debe estar en el formato año-mes-día',

        'fechaDevolucion.required'=>'Se requiere fecha de devolucion',
        'fechaDevolucion.dato_format'=>'La fecha debe estar en el formato año-mes-día',
        'fechaDevolucion.after'=>' La fecha de devolucion, debe ser posterior a la fecha de prestamo',


        'fechaRealDevolucion.required'=>'Se requiere fecha',
        'fechaRealDevolucion.dato_format'=>'La fecha debe estar en el formato año-mes-día',
        'fechaDevolucion.after_or_equal'=>' La fecha de real de devolucion, debe ser posterior o igual a la fecha de devolucion',


    ];

    
    public $rulesCliente=[
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
        'cedula.numeric' => 'Solo se permiten numeros',
        'cedula.digits' => 'Solo se permiten 10 numeros',
        'cedula.unique' => 'No debe de existir dos numeros de cedula iguales',
        'correo.required' => 'Se requiere el correo electronico del cliente',
        'correo.email' => 'Se requiere el correo electronico del cliente en formato email',
        'correo.unique' => 'No deben de existir dos direcciones de correo electronico iguales',
        'telefono.required' => 'Se requiere el numero telefonico del cliente',
        'telefono.numeric' => 'Solo se permiten numeros',
        'telefono.digits' => 'Solo se permiten 10 numeros',
        'telefono.unique' => 'No deben de existir dos numeros de telefono iguales',

    ];
 */


    public function index()
    {
        $prestamo = Prestamo::with('Libro', 'Cliente', 'Usuario')->get();

        return response()->json([
            'prestamos' => $prestamo
        ]);
    }

    public function store(Request $request)
    {
        /* $validator=Validator::make($request->all(),$this->rulesCliente,$this->messages);
        if($validator -> fails()){
            $messages=$validator->messages();
            return response()->json([
                'messages'=>$messages
            ],500);
        } 

        $validator=Validator::make($request->all(),$this->rulesPrestamo,$this->messagesU);
        if($validator -> fails()){
            $messagesU=$validator->messages();
            return response()->json([
                'messages'=>$messagesU
            ],500);
        } 



        $usuario = auth()->user();

        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'correo' => $request->correo,
            'telefono' => $request->telefono

        ]);

        $libro=Libro::find($request->libro_id);
        $libro->estado=false;
        $libro->save();

        $prestamo= new Prestamo();
        $prestamo->cliente_id=$cliente->id;
        $prestamo->usuario_id=$usuario->id;
        $prestamo->libro_id=$libro->id;

        $prestamo->fechaPrestamo=$request->fechaPrestamo;
        $prestamo->fechaDevolucion=$request->fechaDevolucion;
        $prestamo->save(); */
        //return response()->json($request);
        $validData = $request->validate([

            'fechaDevolucion' => 'required',
            'fechaPrestamo' => 'required',
            'libro_id' => 'required',
            'usuario_id' => 'required',
            
        ]);
        Prestamo::create([
            'fechaDevolucion' => $validData['fechaDevolucion'],
            'fechaPrestamo' => $validData['fechaPrestamo'],
            'usuario_id' => $validData['usuario_id'],
            'libro_id' => $validData['libro_id'],
            'isBorrowed' => true,
            'isReturn' => false,
        ]);

        return response()->json(['message' => 'Registrado'],200);
    }

    public function bookLend($id)
    {

        $prestamo = Prestamo::with('Libro')
            ->where('usuario_id', '=', $id)->get();

        return response()->json($prestamo);
    }



    public function show($id)
    {
        $prestamo = Prestamo::with('Libro', 'Cliente', 'Usuario')->where('id', '=', $id)->get();

        return response()->json([
            'prestamos' => $prestamo
        ]);
    }

    public function devolverLibro(Request $request, $id)
    {
        /* $validator = Validator::make($request->only('fechaRealDevolucion'), $this->rulesPrestamo, $this->messagesU);
        if ($validator->fails()) {
            $messagesU = $validator->messages();
            return response()->json([
                'messages' => $messagesU
            ], 500);
        }

        $libro = Libro::findOrFail($id);
        $libro->estado = true;
        $libro->save();

        $prestamo = Prestamo::where('libro_id', '=', $id)->first();

        $prestamo->fechaRealDevolucion = $request->fechaRealDevolucion;
        $prestamo->save();

        return response()->json([
            'message' => 'Libro devuelto con éxito'
        ]); */
    }

    public function listado()
    {

        $prestamo = Libro::with('Prestamo.Cliente', 'Prestamo.Usuario')->where('libros.estado', '=', false)->get();
        return response()->json([
            'Prestamos' => $prestamo
        ]);
    }


    public function listadoUC()
    {

        $clientes = Cliente::all();
        $usuarios = Usuario::where('rol_id', '=', 2)->get();


        return response()->json([

            'clientes' => $clientes,
            'usuarios' => $usuarios
        ]);
    }

    public function update(Request $request,  $id)
    {
    }

    public function destroy($id)
    {
    }
}
