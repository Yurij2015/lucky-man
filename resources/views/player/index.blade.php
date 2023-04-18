@extends('main')
@section('content')
    <div class="container">
        @if($player)
            <h3>Player block!</h3>
            <h5>{{ $player->username }}</h5>
            <h6>{{ $player->phone }}</h6>
            <div class="game">

            </div>

        @else
            <h3>Url is incorrect!</h3>
        @endif
    </div>
@stop
