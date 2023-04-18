<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerSaveRequest;
use App\Models\AccessToken;
use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request)
    {

        $token = $request->token;
        $getPlayerViaToken = AccessToken::with('player')->where('token', $token)->first();
        return view('player.index', ['player' => $getPlayerViaToken]);
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
        $tokenData = $this->accessTokenCreate($player);
        return redirect()->route('player-register-form', ['token' => $tokenData->token]);
    }

    public function accessTokenCreate($player)
    {
        return AccessToken::create([
            'player_id' => $player->id,
            'token' => $this->getRandomStringToken($player),
            'token_validity_period' => date("Y-m-d\ H:i:s\ ", strtotime("+7 day")),
            'status' => true
        ]);
    }

    public function getRandomStringToken(Player $player): string
    {
        return md5($player->username . $player->phone);
    }
}
