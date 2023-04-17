<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerSaveRequest;
use App\Models\AccessToken;
use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        return view('player.index');
    }

    public function playerRegisterForm(Request $request)
    {
        if ($request->token) {
            return view('player.register', ['token' => $request->token]);
        }
        return view('player.register');
    }

    public function playerCreate(PlayerSaveRequest $playerSaveRequest): RedirectResponse
    {
        $player = Player::create($playerSaveRequest->all());
        $token = AccessToken::create([
            'player_id' => $player->id,
            'token' => $this->getRandomStringUniqid($player),
            'token_validity_period' => date("Y-m-d\ H:i:s\ ", strtotime("+7 day")),
            'status' => true
        ]);
        return redirect()->route('player-register-form', ['token' => $token->token]);
    }

    public function getRandomStringUniqid(Player $player): string
    {
        return md5($player->username . $player->phone);
    }
}
