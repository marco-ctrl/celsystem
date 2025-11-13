<?php

namespace Src\admin\lider\infrastructure\controllers;

use App\Http\Controllers\Controller;
use App\Mail\StoreLiderMail;
use App\Models\Lider;
use App\Models\SendMailInvitation;
use App\Models\User;
use App\Services\TwilioService;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Src\admin\lider\infrastructure\validators\StoreLiderRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

final class StoreLiderPOSTController extends Controller
{
    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function index(StoreLiderRequest $request): JsonResponse
    {
        try {
            $password = $this->generatePassword(6);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($password),
                'tipe' => 1,
            ]);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error al crear usuario',
                ], Response::HTTP_OK);
            }

            $foto = null;

            if ($request->foto) {
                // Decodifica la imagen base64
                $imageData = $request->foto;

                list($type, $imageData) = explode(';', $imageData);
                list(, $imageData) = explode(',', $imageData);

                $imageData = base64_decode($imageData);

                // Ruta física en /public/images
                $fileName = uniqid() . '.png';
                $imagePath = public_path('images/perfil/' . $fileName);

                // Guarda la imagen directamente en public/
                file_put_contents($imagePath, $imageData);

                // Guarda la ruta relativa que usarás en la BD
                $foto = 'images/perfil/' . $fileName;
            }

            $lider = Lider::create([
                'name' => strtoupper($request->name),
                'lastname' => strtoupper($request->lastname),
                'birthdate' => Carbon::parse($request->birthdate)->format('Y-m-d'),
                'addres' => strtoupper($request->addres),
                'contact' => $request->contact,
                'foto' => $foto,
                'user_id' => $user->id,
                'status' => 1,
                'code' => $request->code,
            ]);

            if (!$lider) {
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

            if (!$sendEmail) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error al mail',
                ], Response::HTTP_OK);
            }

            // Enviar mensaje de WhatsApp
            /*$message = "Hola {$user->name}, bienvenido a nuestra plataforma.";
            $response = $this->whatsAppService->sendMessage($lider->contact, $message);

            if (isset($response['status']) && $response['status'] === true) {
                return response()->json(['message' => 'Usuario creado y mensaje enviado por WhatsApp'], 201);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to save user',
                    'error' => $response['error'] ?? 'Unknown error'
                ], 500);
            }*/

            /*if ($response['status'] === false) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to save user',
                    'error' => $response['error']
                ], 500);
            }*/

            // Mail::to($user->email)->send(new StoreLiderMail($lider->name . ' ' . $lider->last_name, $token));

            return response()->json([
                'status' => true,
                'message' => 'Lider creado correctamente',
                'lider' => $lider,
                'user' => $user,
                'pass' => $password,
                'token' => $token,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('Failed to save Lider'),
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function generatePassword(int $length = 6): string
    {
        $length = max(6, $length);

        $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lower = 'abcdefghijklmnopqrstuvwxyz';
        $digits = '0123456789';
        $special = '!@#$%^&*()-_=+[]{}<>?';

        // Garantizar al menos un carácter de cada tipo exigido
        $passwordChars = [];
        $passwordChars[] = $upper[random_int(0, strlen($upper) - 1)];
        $passwordChars[] = $digits[random_int(0, strlen($digits) - 1)];
        $passwordChars[] = $special[random_int(0, strlen($special) - 1)];

        $all = $upper . $lower . $digits . $special;
        for ($i = count($passwordChars); $i < $length; $i++) {
            $passwordChars[] = $all[random_int(0, strlen($all) - 1)];
        }

        shuffle($passwordChars);

        return implode('', $passwordChars);
    }
}
