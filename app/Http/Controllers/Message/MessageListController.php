<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Message\Infra\Interfaces\MessageInterface;
use TechArena\Funcionalities\Message\Message;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;
use TechArena\Funcionalities\UserChat\Infra\Model\UserChat;

class MessageListController extends Controller
{

    private UserInterface $user;
    private Message $message;
    public function __construct(UserInterface $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }
    public function __invoke(Request $request)
    {
        $limit = $request->input('limit', 20); // valor padrão de 10 se não for fornecido
        $offset = $request->input('offset', 0);
        
        try {
            $userDecoded = $this->autheticateToken($request["idToken"]);
            $email = $userDecoded->email;
            $user = $this->user->select($email);
            $chat_id = $request["chat_id"];
            $user_chat = new UserChat($chat_id, $user->getId());
            $messages = $this->message->listMessages($user_chat, $limit, $offset);
            return response()->json($messages, 200);
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
