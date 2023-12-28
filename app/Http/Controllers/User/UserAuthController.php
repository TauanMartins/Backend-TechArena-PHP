<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use DateInterval;
use DateTime;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Permission\Infra\Interfaces\PermissionInterface;
use TechArena\Funcionalities\User\Infra\Model\User as UserModel;
use TechArena\Funcionalities\User\User;

class UserAuthController extends Controller
{
    private User $auth;
    private PermissionInterface $permissions;
    public function __construct(User $auth, PermissionInterface $permissions)
    {
        $this->auth = $auth;
        $this->permissions = $permissions;
    }
    public function __invoke(Request $request)
    {
        try {
            $userDecoded = $this->autheticateToken($request["idToken"]);
            $email = $userDecoded->email;
            $username = strstr($email, '@', true);
            $dt_birth = $request['dt_birth'] ? DateTime::createFromFormat('Y-m-d', $request['dt_birth']) : (new DateTime())->sub(new DateInterval('P18Y'));
            $gender = ($request['gender'] == 'Male') ? 'M' : (($request['gender'] == 'Female') ? 'F' : 'O');
            $age = $dt_birth->diff(new DateTime())->y;            
            if ($age < 18) throw new Exception('Você não possui idade suficiente :(');
            $permission = $this->permissions->selectBySlug('user');

            $user = new UserModel(
                $userDecoded->name,
                $username,
                $userDecoded->picture,
                $email,
                $dt_birth,
                $gender,
                $permission->getId()
            );
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
