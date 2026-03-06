<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Registra un nuevo usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ],
        [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.max' => 'El nombre debe tener menos de 255 caracteres',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser una dirección de email válida',
            'email.unique' => 'El email ya está registrado',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ]);

        if ($validated->fails()) {
            $data = [
                'status' => 'error',
                'message' => 'Error al registrar el usuario',
                'errors' => $validated->errors(),
            ];

            return response()->json($data, 422);
        }

        // Obtenemos el rol de usuario
        $userRole = Role::where('name', 'User')->first();

        // Creamos el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $userRole->id,
        ]);

        // Creamos el carrito vinculado al usuario
        $cart = Cart::create(['user_id' => $user->id]);
        
        // Generamos el token de acceso
        $token = Auth::login($user);

        $data = [
            'status' => 'success',
            'message' => 'Usuario registrado correctamente',
            'user' => $user,
            'cart' => $cart,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ];

        return response()->json($data, 201);
    }

    /**
     * Inicia sesión del usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ],
        [
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser una dirección de email válida',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ]);

        if ($validated->fails()) {
            $data = [
                'status' => 'error',
                'message' => 'Error al iniciar sesión',
                'errors' => $validated->errors(),
            ];

            return response()->json($data, 422);
        }

        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        
        if (!$token) {
            $data = [
                'status' => 'error',
                'message' => 'Credenciales incorrectas',
            ];

            return response()->json($data, 401);
        }

        $user = Auth::user();
        
        $data = [
            'status' => 'success',
            'message' => 'Usuario logueado correctamente',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ];

        return response()->json($data, 200);
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        
        $data = [
            'status' => 'success',
            'message' => 'Usuario deslogueado correctamente',
        ];

        return response()->json($data, 200);
    }

    /**
     * Actualiza el token de acceso del usuario.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $data = [
            'status' => 'success',
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ],
        ];
        
        return response()->json($data, 200);
    }
}
