@extends('main')
@section('content')
    <div class="container">
        @if($player)
            <h3>Player block!</h3>
        @else
            <h3>Url is incorrect!</h3>
        @endif
    </div>
@stop
