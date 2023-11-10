<?php

namespace App\Http\Controllers\Preference;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Preference\Infra\Interfaces\PreferenceInterface;
use TechArena\Funcionalities\UserPreference\Infra\Model\UserPreference;
use TechArena\Funcionalities\UserPreference\Infra\Interfaces\UserPreferencePreferedThemeInterface;
use TechArena\Funcionalities\User\User;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class UserPreferedThemeController extends Controller
{
    private User $auth;
    private UserInterface $repository1;
    private PreferenceInterface $repository2;
    private UserPreferencePreferedThemeInterface $repository3;
    public function __construct(User $auth, UserInterface $repository1, PreferenceInterface $repository2, UserPreferencePreferedThemeInterface $repository3)
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
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
