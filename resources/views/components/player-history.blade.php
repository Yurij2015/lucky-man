<h3 class="mt-3">Player history</h3>
<table class="table table-hover" aria-label="player history">
    <thead>
    <tr>
        <th scope="col">Latest points</th>
        <th scope="col">Lose/Win</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    @foreach($history as $item)
        <tr>
            <td>{{$item->points}}</td>
            <td>{{$item->points% 2 ? 'Lose' : 'Win'}}</td>
            <td>{{$item->created_at}}</td>
        </tr>
    @endforeach
</table>
