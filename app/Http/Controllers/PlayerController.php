<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerSaveRequest;
use App\Models\Player;
use Illuminate\Http\RedirectResponse;

class PlayerController extends Controller
{
    public function index()
    {
        return view('player.index');
    }

    public function playerRegisterForm()
    {
        return view('player.register');
    }

    public function playerCreate(PlayerSaveRequest $saveRequest): RedirectResponse
    {
        Player::create($saveRequest->all());
        return redirect()->route('index');
    }
}
