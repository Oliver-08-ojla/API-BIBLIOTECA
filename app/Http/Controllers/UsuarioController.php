<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class UsuarioController extends Controller
{

    public $rulesUsuario= [

        'nombre'=>'required|string|max:255|min:2|regex:/^[\pL\s]+$/u',
        'apellido'=>'required|max:255|min:2|regex:/^[\pL\s]+$/u',
        'cedula'=>'required|numeric|digits:10|unique:usuarios',
        'correo'=>'required|email|unique:usuarios',
        'password'=>'required|min:8'
        

    ];


    public $messages=[

        'nombre.required' => 'Se requiere el nombre del usuario',
        'nombre.string' => 'Se requiere se permiten',
        'nombre.regex' => 'Solo letras',
        'nombre.max' => 'Excedio el maximo de caracteres',
        'nombre.min' => 'El nombre tiene que tener minimo 2 caracteres',
        'apellido.required' => 'Se requiere el apellido del usuario',
        'apellido.string' => 'Se requiere se permiten',
        'apellido.regex' => 'Solo letras',
        'apellido.max' => 'Excedio el maximo de caracteres',
        'apellido.min' => 'El apellido tiene que tener minimo 2 caracteres',
        'cedula.required' => 'Se requiere la cedula del usuario',
        'cedula.numeric' => 'Solo se permiten numero',
        'cedula.digits' => 'Solo se permiten 10 numeros',
        'cedula.unique' => 'No debe de existir dos numeros de cedula iguales',
        'correo.required' => 'Se requiere el correo electronico del usuario',
        'correo.email' => 'Se requiere el correo electronico del usuario en formato email',
        'correo.unique' => 'No deben de existir dos direcciones de correo electronico iguales',
        'password.required'=>'Se requiere password',
        'password.min'=>'Password tiene que tener minimo 8 caracteres',
        
    ];
    


    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),$this->rulesUsuario,$this->messages);
        if($validator -> fails()){
            $messages=$validator->messages();
            return response()->json([
                'messages'=>$messages
            ],500);
        } 

    
       $usuario=new Usuario();
       $usuario->nombre=$request->nombre;
       $usuario->apellido=$request->apellido;
       $usuario->cedula=$request->cedula;
       $usuario->correo=$request->correo;
       $usuario->password=Hash::make($request->password);
       $usuario->rol_id=2;
       $usuario->save();

       return response()->json([
        'messages'=>"Registro exitoso"
    ]);
    }

    public function login(Request $request)
    {

        $usuario=Usuario::where("correo", "=", $request->correo)->first();

        if(isset($usuario->id)){
            if(Hash::check($request->password, $usuario->password)){
                $token = $usuario->createToken("auth_token")->plainTextToken;
                return response()->json([
                    'messages'=>"Usuario logueado correctamente",
                    "access_token"=>$token
                 ]);
            }else 
                 return response()->json([
                    'messages'=>"Password incorrecta"
                 ]);
        }else{
            return response()->json([
                'messages'=>"Usuario no registrado"
            ]);
        }
            
    }

    public function userProfile()
    {
        return response()->json([
            'messages'=>"Acerca del perfil de usuario",
            'data'=>auth()->user(),
            'rol'=>auth::user()->Rol->nombre
         ]);
    }
   

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'messages'=>"Cierre de sesion",

         ]);
    }
}
