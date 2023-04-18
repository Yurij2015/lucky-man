<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerSaveRequest;
use App\Http\Services\PlayerService;
use App\Models\AccessToken;
use App\Models\Player;
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

    public function playerCreate(PlayerSaveRequest $playerSaveRequest, PlayerService $playerService): RedirectResponse
    {
        $player = Player::create($playerSaveRequest->all());
        $tokenData = $playerService->accessTokenCreate($player);
        return redirect()->route('player-register-form', ['token' => $tokenData->token]);
    }

    /**
     * @throws Exception
     */
    public function playerGame(Request $request, PlayerService $playerService)
    {
        $token = $request->token;
        $getPlayerViaToken = AccessToken::with('player')->where('token', $token)->where('status', true)->first();
        $points = random_int(1, 1000);
        $playerService->playerPointsSave($getPlayerViaToken, $points);
        return view('player.index', ['player' => $getPlayerViaToken, 'token' => $token, 'points' => $points]);
    }
}
