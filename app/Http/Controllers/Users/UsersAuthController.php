<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use DateTime;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Users\Infra\Model\User;
use TechArena\Funcionalities\Users\Users;

class UsersAuthController extends Controller
{
    private Users $auth;
    public function __construct(Users $auth)
    {
        $this->auth = $auth;
    }
    public function __invoke(Request $request)
    {
        try {
            $userDecoded = $this->autheticateToken($request["idToken"]);
            $age = DateTime::createFromFormat('Y-m-d', $request['dt_birth'])->diff(new DateTime())->y;
            if($age<18) throw new Exception('Você não possui idade suficiente :(');
            $user = new User($userDecoded->name, null, $userDecoded->picture, $userDecoded->email, DateTime::createFromFormat('Y-m-d', $request['dt_birth']), $request['gender']);
            $response = $this->auth->domain($user);
            return response()->json($response, 200);
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
