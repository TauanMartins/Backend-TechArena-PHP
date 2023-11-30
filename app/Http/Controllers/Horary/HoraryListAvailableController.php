<?php

namespace App\Http\Controllers\Horary;

use App\Http\Controllers\Controller;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use TechArena\Funcionalities\Appointment\Infra\Interfaces\AppointmentInterface;
use TechArena\Funcionalities\Horary\Infra\Interfaces\HoraryInterface;
use TechArena\Funcionalities\User\Infra\Interfaces\UserInterface;

class HoraryListAvailableController extends Controller
{
    private HoraryInterface $horary;
    public function __construct(HoraryInterface $horary)
    {
        $this->horary = $horary;
    }
    public function __invoke(Request $request)
    {

        $sport_id = $request->input('sport_id');
        $arena_id = $request->input('arena_id');
        $date = DateTime::createFromFormat('Y-m-d', $request['date']);

        try {
            $horarys = $this->horary->select($sport_id, $arena_id, $date);
            return response()->json($horarys, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
