<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class ChatListController extends Controller
{
    private UserInterface $user;
    private ChatInterface $chat;
    public function __construct(UserInterface $user, ChatInterface $chat)
    {
        $this->user = $user;
        $this->chat = $chat;
    }
    public function __invoke(Request $request)
    {
        try {
            $userDecoded = $this->autheticateToken($request["idToken"]);
            $email = $userDecoded->email;
            $user = $this->user->select($email);
            $friendsChats = $this->chat->selectAll($user);
            $teamsChats = $this->chat->selectAllTeamChats($user);
            $appointmentsChats = $this->chat->selectAllAppointmentsChats($user);
            return response()->json(['friendsChats' => $friendsChats, 'teamsChats' => $teamsChats, 'appointmentsChats' => $appointmentsChats], 200);
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
