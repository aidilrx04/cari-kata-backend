<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGameRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!Auth::check()) return response()->json(null, 401);

        // retrieve only games related to user

        $user_id = Auth::id();

        $games = Game::where('user_id', $user_id)->get();

        return GameResource::collection($games);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request)
    {
        $user_id = Auth::id();
        $grid = $request->grid;
        $game = new Game();
        $game->fill($request->safe()
            ->only(['title', 'words']));
        $game->user_id = $user_id;
        $game->save();

        $game->grid()->create([
            'rows' => $grid['rows'],
            'columns' => $grid['columns'],
            'grid' => $grid['grid'],
            'solved' => $this->transformSolvedNullToEmptyString($grid['solved'])
        ]);

        $game->refresh();

        return new GameResource($game);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return new GameResource($game);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        $inputs = $request->safe();

        // transform solved null items to empty string
        $solved = null;
        if ($inputs->has('grid.solved'))
            $solved = $this->transformSolvedNullToEmptyString($inputs->grid['solved']);

        $new_grid = $inputs->grid;
        $new_grid['solved'] = $solved;
        $new_grid = array_filter($new_grid);
        $inputs = $inputs->merge(['grid' => $new_grid]);

        $game->grid->update($inputs->grid);
        $game->update($inputs->all());

        return new GameResource($game);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $success = $game->delete();
        return response()->json(null, $tatus = $success ? 200 : 404);
    }


    private function transformSolvedNullToEmptyString(array $solved)
    {
        for ($i = 0; $i < count($solved); $i++) {
            $row = $solved[$i];
            for ($j = 0; $j < count($row); $j++) {
                $cell = $row[$j];
                if ($cell === null) {
                    $solved[$i][$j] = "";
                }
            }
        }
        return $solved;
    }
}
