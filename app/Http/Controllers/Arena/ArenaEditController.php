<?php

namespace App\Http\Controllers\Arena;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TechArena\Funcionalities\Arena\Infra\Interfaces\ArenaInterface;
use TechArena\Funcionalities\Arena\Infra\Model\Arena;
use TechArena\Funcionalities\AWS\Interfaces\AWSInterface;
use TechArena\Funcionalities\SportArena\Infra\Interfaces\SportArenaInterface;
use TechArena\Funcionalities\SportArena\Infra\Model\SportArena;

class ArenaEditController extends Controller
{
    private ArenaInterface $arenas;
    private SportArenaInterface $sportArena;
    private AWSInterface $s3;
    public function __construct(ArenaInterface $arenas, AWSInterface $s3, SportArenaInterface $sportArena)
    {
        $this->arenas = $arenas;
        $this->sportArena = $sportArena;
        $this->s3 = $s3;
    }
    public function __invoke(Request $request)
    {
        try {
            $oldArena = $this->arenas->select($request['id']);
            if ($oldArena->getImage() !== $request['image']) {
                $imageUrl = $this->s3->editImage('arenas', $oldArena->getImage() ? $oldArena->getAddress() : null, $request['address'], $request['image']);
            } else {
                $imageUrl = $oldArena->getImage(); // Mantém a imagem atual, já que não houve mudança
            }
            $arena = new Arena(
                $request['address'],
                $request['lat'],
                $request['longitude'],
                $imageUrl,
                $request['is_league_only']
            );
            $arena->setId($request['id']);
            $sports = $request['sports'];
            DB::beginTransaction();
            try {
                $arenas = $this->arenas->update($arena);
                $this->sportArena->delete($arena);
                foreach ($sports as $sport) {
                    $sport = new SportArena($sport, $arena->getId());
                    $this->sportArena->create($sport);
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
            return response()->json($arenas, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
