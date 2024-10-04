<?php

namespace Src\admin\lider\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Mail\StoreLiderMail;
use App\Models\Lider;
use App\Models\SendMailInvitation;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Src\admin\lider\infrastructure\validators\StoreLiderRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

final class StoreLiderPOSTController extends Controller
{
    public function index(StoreLiderRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('password'),
                'tipe' => 1,
            ]);

            if(!$user){
                return response()->json([
                    'status' => false,
                    'message' => 'Error al crear usuario',
                ], Response::HTTP_OK);
            }

            $foto = null;
            if ($request->foto) {
                // Decodifica la imagen base64 y guarda el archivo
                $imageData = $request->foto;
                list($type, $imageData) = explode(';', $imageData);
                list(, $imageData)      = explode(',', $imageData);
                $imageData = base64_decode($imageData);
                $imagePath = 'images/' . uniqid() . '.png'; // Puedes ajustar el nombre y formato del archivo
                Storage::disk('public')->put($imagePath, $imageData);
                $foto = $imagePath;
            }

            $lider = Lider::create([
                    'name' => strtoupper($request->name),
                    'lastname' => strtoupper($request->lastname),
                    'birthdate' => $request->birthdate,
                    'addres' => strtoupper($request->addres),
                    'contact' => strtoupper($request->contact),
                    'foto' => $foto,
                    'user_id' => $user->id,
            ]);

            if(!$lider){
                return response()->json([
                    'status' => false,
                    'message' => 'Error al crear lider',
                ], Response::HTTP_OK);
            }

            // Generate a unique token
            do {
                // Generate a random string of 60 characters
                $token = Str::random(60) . '-' . time();
                // Check if the token already exists in the RecoveryPassword table
                $tokenExists = SendMailInvitation::where('token', $token)->exists();
            } while ($tokenExists); // Repeat generation if token already exists

            $sendEmail = SendMailInvitation::create([
                'email' => $user->email,
                'token' => $token,
                'lider_id' => $lider->id,
            ]);

            if(!$sendEmail)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Error al mail',
                ], Response::HTTP_OK);
            }

           // Mail::to($user->email)->send(new StoreLiderMail($lider->name . ' ' . $lider->last_name, $token));

            return response()->json([
                'status' => true,
                'message' => 'Lider creado correctamente',
                'data' => $lider,
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('Failed to save Lider'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}