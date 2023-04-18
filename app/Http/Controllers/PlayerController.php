<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerSaveRequest;
use App\Models\AccessToken;
use App\Models\Player;
use App\Models\PlayerPoints;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request)
    {

        $token = $request->token;
        $getPlayerViaToken = AccessToken::with('player')->where('token', $token)->where('status', true)->first();
        return view('player.index', ['player' => $getPlayerViaToken?->player, 'token' => $getPlayerViaToken?->token]);
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

    private function accessTokenCreate($player)
    {
        return AccessToken::create([
            'player_id' => $player->id,
            'token' => $this->getRandomStringToken($player),
            'token_validity_period' => date("Y-m-d\ H:i:s\ ", strtotime("+7 day")),
            'status' => true
        ]);
    }

    /**
     * @throws Exception
     */
    public function playerGame(Request $request)
    {
        $token = $request->token;
        $getPlayerViaToken = AccessToken::with('player')->where('token', $token)->where('status', true)->first();
        $points = random_int(1, 1000);
        $this->playerPointsSave($getPlayerViaToken, $points);
        return view('player.index', ['player' => $getPlayerViaToken, 'token' => $token, 'points' => $points]);
    }

    private function playerPointsSave($getPlayerViaToken, $points): void
    {
        PlayerPoints::create([
            'player_id' => $getPlayerViaToken?->player->id,
            'points' => $points
        ]);
    }

    private function getRandomStringToken(Player $player): string
    {
        return md5($player->username . $player->phone . time());
    }
}
