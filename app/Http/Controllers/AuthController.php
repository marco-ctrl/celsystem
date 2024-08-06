<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group User Authentication Process
 */
class AuthController extends Controller
{
    /**
     * Create User
     *
     * Register a new user.
     *
     * @unauthenticated
     *
     * @bodyParam name string required The NAME of the User. Example: John
     * @bodyParam last_name string required The LAST_NAME of the User. Example: Doe
     * @bodyParam email string required [Email|Unique] The EMAIL of the User. Example: email@example.com
     * @bodyParam password string required [Min:8] The PASSWORD of the user. Example: xxxxxxxx
     * @bodyParam password_confirmation string required [Min:8] To confirm the PASSWORD of the user. Example: xxxxxxxx
     *
     * @param Request $request
     * @return User
     */
    public function storeUser(UserRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user->addRoleCustomer();

            return response()->json([
                'status' => true,
                'message' => __('User Created Successfully'),
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => __('Failed to create user'),
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Login
     *
     * Sign in to the application.
     *
     * @unauthenticated
     *
     * @bodyParam email string required [Email|Unique] The EMAIL of the User. Example: email@example.com
     * @bodyParam password string required [Min:8] The PASSWORD of the user. Example: xxxxxxxx
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(LoginUserRequest $request): JsonResponse
    {
        try {
            //Aquí se busca el usuario por email
            $user = User::where('email', $request->email)->first();

            //Se Verifica si el usuario existe y la contraseña es correcta
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => __('Invalid credentials')
                ], Response::HTTP_UNAUTHORIZED);
            }

            //Aquí se genera el token de autenticación para el usuario
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => __('User logged in successfully'),
                'token' => $token,
                'user' => $user
            ], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => __('Failed to login user'),
                'error' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Logout
     *
     * Sign out of the application
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutUser(Request $request): JsonResponse
    {
        try {
            $request->user()->tokens()->delete(); // Elimina todos los tokens del usuario al cerrar la sesión

            return response()->json([
                'status' => true,
                'message' => __('User logged out successfully')
            ], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => __('Failed to logout user'),
                'error' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}