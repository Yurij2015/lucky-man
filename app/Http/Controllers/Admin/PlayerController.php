<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerSaveRequest;
use App\Http\Services\PlayerService;
use App\Models\Player;
use App\Models\PlayerPoints;
use Illuminate\Http\RedirectResponse;

class PlayerController extends Controller
{
    public function showPlayer(Player $player)
    {
        $playerPoints = PlayerPoints::where('player_id', $player->id)->paginate(15);
        return view('admin.player.show', compact('player'), compact('playerPoints'));
    }

    public function updatePlayerForm(Player $player)
    {
        return view('admin.player.update', compact('player'));
    }

    public function addPlayerForm()
    {
        return view('admin.player.create');
    }

    public function playerCreate(PlayerService $playerService, PlayerSaveRequest $playerSaveRequest): RedirectResponse
    {
        $player = Player::create($playerSaveRequest->all());
        $playerService->accessTokenCreate($player);
        return redirect()->route('player-show', $player->id);
    }

    public function updatePlayer(Player $player, PlayerSaveRequest $playerSaveRequest): RedirectResponse
    {
        $player->update($playerSaveRequest->all());
        return redirect()->route('player-show', $player->id);
    }

    public function destroyPlayer(Player $player): RedirectResponse
    {
        $player->delete();
        return redirect()->route('admin');
    }
}
