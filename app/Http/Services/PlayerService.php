<?php

namespace App\Http\Services;

use App\Models\AccessToken;
use App\Models\Player;
use App\Models\PlayerPoints;

class PlayerService
{
    public function accessTokenCreate($player)
    {
        return AccessToken::create([
            'player_id' => $player->id,
            'token' => $this->getRandomStringToken($player),
            'token_validity_period' => date("Y-m-d\ H:i:s\ ", strtotime("+7 day")),
            'status' => true
        ]);
    }

    private function getRandomStringToken(Player $player): string
    {
        return md5($player->username . $player->phone . time());
    }

    public function playerPointsSave($getPlayerViaToken, $points): void
    {
        PlayerPoints::create([
            'player_id' => $getPlayerViaToken?->player->id,
            'points' => $points
        ]);
    }
}
