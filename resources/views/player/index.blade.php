@extends('main')
@section('content')
    <div class="container">
        @if($player)
            <h3>Are you that lucky guy? Check it out!!!</h3>
            <span>{{ $player->username }}</span>
            <span>{{ $player->phone }}</span>
            <div class="game">
                <form method="post" action="{{ route('player-game') }}">
                    @csrf
                    <label>
                        <input hidden="hidden" name="token" value={{ $token }}>
                    </label>
                    <button type="submit" class="btn btn-success">Im feeling lucky</button>
                </form>
            </div>
            @if(isset($points))
                {{ $points }}
            @endif
        @else
            <h3>Url is incorrect!</h3>
        @endif
    </div>
@stop
