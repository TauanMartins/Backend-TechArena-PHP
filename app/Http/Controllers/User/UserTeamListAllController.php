<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class UserTeamListAllController extends Controller
{
    private UserInterface $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    public function __invoke(Request $request)
    {
        try {
            $userDecoded = $this->autheticateToken($request["idToken"]);
            $email = $userDecoded->email;
            $user = $this->user->select($email);
            $teams = $this->user->selectUserTeams($user);
            return response()->json(['teams' => $teams], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

    }
    public function autheticateToken(string $token)
    {
        $idToken = $token;
        // Verificar Tipo de criptografia e kid do token
        $alg = JWT::jsonDecode(JWT::urlsafeB64Decode(explode('.', $idToken)[0]))->alg;
        $kid = JWT::jsonDecode(JWT::urlsafeB64Decode(explode('.', $idToken)[0]))->kid;
        // Escolher certificado com base no Kid correto
        $certificates = file_get_contents('https://www.googleapis.com/oauth2/v1/certs');
        $certificates = json_decode($certificates, true);
        $secretKey = $certificates[$kid];
        return JWT::decode($idToken, new Key($secretKey, $alg));
    }
}
