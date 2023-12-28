<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Chat\Infra\Interfaces\ChatInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;
use TechArena\Funcionalities\UserChat\Infra\Interfaces\UserChatInterface;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;

class ChatPrivateDetailController extends Controller
{
    private UserInterface $user;
    private UserChatInterface $userChat;
    private ChatInterface $chat;
    public function __construct(UserInterface $user, ChatInterface $chat, UserChatInterface $userChat)
    {
        $this->user = $user;
        $this->chat = $chat;
        $this->userChat = $userChat;
    }
    public function __invoke(Request $request)
    {
        try {
            $userDecoded = $this->autheticateToken($request["idToken"]);
            $chat_id = $request["chat_id"];
            $email = $userDecoded->email;
            $user = $this->user->select($email);
            $user_chat = new UserChat($chat_id, $user->getId());
            $response = $this->userChat->selectPrivateChatDetail($user_chat);
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
