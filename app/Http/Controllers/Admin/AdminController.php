<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Contracts\Support\Renderable;

class AdminController extends Controller
{
    /**
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $players = Player::paginate(15);
        return view('admin.index', compact('players'));
    }
}
