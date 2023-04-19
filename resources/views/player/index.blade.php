@extends('main')
@section('content')
    <div class="container">
        @if($player)
            <div class="container">
                <label for="myInput">Uniq link to user - {{ $player->username }} with phone
                    - {{ $player->phone }}</label>
                <div class="form-group">
                    <input class="form-control" type="text"
                           value="{{ route('index') . '/?token=' . $token }}"
                           id="myLink">
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <button class="btn btn-primary mt-2 button-width" onclick="copyLink()">
                            Copy my link!
                        </button>
                    </div>
                    <div class="col-md-2">
                        <form method="post" class="form-inline" action="{{ route('new-link-generate') }}">
                            @csrf
                            <label>
                                <input hidden="hidden" name="token" value="{{ $token }}">
                            </label>
                            <button type="submit" class="btn btn-outline-primary mt-2 button-width">
                                Generate new link
                            </button>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <form method="post" class="form-inline" action="{{ route('destroy-link') }}">
                            @csrf
                            @method('PUT')
                            <label>
                                <input hidden="hidden" name="token" value="{{ $token }}">
                            </label>
                            <button type="submit" class="btn btn-outline-primary mt-2 button-width">
                                Destroy link
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-8">
                        <h3>Are you that lucky guy? Check it out!!!</h3>
                        <div class="game">
                            <form method="post" action="{{ route('main') }}">
                                @csrf
                                <label>
                                    <input hidden="hidden" name="token" value={{ $token }}>
                                </label>
                                <button type="submit" class="btn btn-success">Im feeling lucky</button>
                            </form>

                            @if(isset($points))
                                <div class="points"><h2>{{ $points }}</h2></div>
                                <div class="result @if($prizeAmount) text-success @else text-danger @endif">
                                    {{ $result }}
                                </div>
                                @if($prizeAmount)
                                    <div class="prizeAmount"> Your prise is - {{ $prizeAmount }}</div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-primary mt-2" onclick="playerHistory()">
                            Show history
                        </button>
                        <div id="history" style="display: none">
                            @if(isset($history))
                                <x-player-history :$history></x-player-history>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h3>Go to register to get your uniq link!</h3>
        @endif
    </div>
@stop
<script>
    function copyLink() {
        let copyText = document.getElementById("myLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
    }

    function playerHistory() {
        let x = document.getElementById("history");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
<style>
    .button-width {
        width: 180px;
    }
</style>
