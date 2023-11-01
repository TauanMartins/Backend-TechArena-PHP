<?php

namespace App\Http\Controllers\Preferences;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Preferences\Infra\Interfaces\PreferencesInterface;
use TechArena\Funcionalities\UserPreferences\Infra\Model\UserPreference;
use TechArena\Funcionalities\UserPreferences\Infra\Interfaces\UserPreferencePreferedThemeInterface;
use TechArena\Funcionalities\Users\Users;
use TechArena\Funcionalities\Users\Infra\Interfaces\UsersInterface;

class UsersPreferedThemeController extends Controller
{
    private Users $auth;
    private UsersInterface $repository1;
    private PreferencesInterface $repository2;
    private UserPreferencePreferedThemeInterface $repository3;
    public function __construct(Users $auth, UsersInterface $repository1, PreferencesInterface $repository2, UserPreferencePreferedThemeInterface $repository3)
    {
        $this->auth = $auth;
        $this->repository1 = $repository1;
        $this->repository2 = $repository2;
        $this->repository3 = $repository3;
    }
    public function __invoke(Request $request)
    {
        try {
            $user = $this->repository1->select($request['user']);
            $preference = $this->repository2->select_specific('prefered_theme');
            $prefered_theme = new UserPreference($user->getId(), $preference->getIdPreference(), $preference->getDescPreference(), $request['prefered_theme']);
            $response = $this->repository3->update($prefered_theme);
            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json('Erro na requisição de dados de usuário. ' . $e->getMessage(), 404);
        }
    }
}
