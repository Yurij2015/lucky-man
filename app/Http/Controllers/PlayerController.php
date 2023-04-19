<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerSaveRequest;
use App\Http\Services\PlayerService;
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
        $result = $points % 2 ? 'Now you\'re the loser' : 'You are now the WINNER!!!';
        $prizeAmount = $points % 2 ? null : $this->getPrizeAmount($points);
        $playerService->playerPointsSave($getPlayerViaToken, $points);
        return view('player.index', [
            'player' => $getPlayerViaToken?->player,
            'token' => $token,
            'points' => $points,
            'result' => $result,
            'prizeAmount' => $prizeAmount,
            'history' => $this->playerHistory($getPlayerViaToken?->player->id)
        ]);
    }

    private function playerHistory($id)
    {
        return PlayerPoints::latest()->where('player_id', $id)->take(3)->get();
    }

    private function getPrizeAmount(int $points): ?float
    {
        foreach ($this->sourceData() as $key => $value) {
            if ($points > $key) {
                return $points * $value;
            }
        }
        if ($points < 300) {
            return $points * 0.1;
        }
        return null;
    }

    private function sourceData(): array
    {
        return [
            900 => 0.7,
            600 => 0.5,
            300 => 0.3
        ];
    }
}
