@extends('main')
@section('content')
    <div class="container">
        @if($player)
            <div class="container">
                <label for="myInput">My link</label>
                <div class="form-group">
                    <input class="form-control" type="text"
                           value="{{ route('index') . '/?token=' . $token }}"
                           id="myLink">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary mt-2" onclick="copyLink()">
                        Copy my link!
                    </button>
                </div>
            </div>
            <div class="container mt-5">
                <h3>Are you that lucky guy? Check it out!!!</h3>
                <span>{{ $player->username }}</span>
                <span>{{ $player->phone }}</span>
                <div class="game">
                    <form method="post" action="{{ route('main') }}">
                        @csrf
                        <label>
                            <input hidden="hidden" name="token" value={{ $token }}>
                        </label>
                        <button type="submit" class="btn btn-success">Im feeling lucky</button>
                    </form>
                </div>
                @if(isset($points))
                    {{ $points }}
                    {{ $result }}
                    {{ $prizeAmount }}
                @endif
            </div>
        @else
            <h3>Url is incorrect!</h3>
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
</script>
