@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
    <h1 class="m-0 text-dark">Player - {{ $player->username }}</h1>
@stop
@php
    $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
                </button>';
    $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
                  </button>';
    $config['paging'] = false;
    $config['searching'] = false;
    $config['info'] = false;
@endphp
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>UserName</th>
                            <th>{!! $player->username !!}</th>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{!! $player->phone !!}</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('admin') }}">
                                    <button class="btn btn-xs btn-default text-danger mx-1 shadow"
                                            title="Back to list of players">
                                        <i class="fa fa-lg fa-fw fa-arrow-circle-left"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <nobr>
                                    <a href="{{ route('update-player-form', $player->id) }}">{!! $btnEdit !!}</a>
                                    <form method="POST" action="{{ route('player-destroy', $player->id) }}"
                                          style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        {!! $btnDelete !!}<i/>
                                    </form>
                                </nobr>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            @if(count($player->accessToken))
                <h3 class="mb-1 text-dark">Tokens of user</h3>
                <div class="card">
                    <div class="card-body">
                        @php
                            $heads = ['#', 'Token','Valid to', 'Status'];
                        @endphp
                        <x-adminlte-datatable id="table1" :heads="$heads" head-theme="light" theme="light" striped
                                              hoverable bordered :config="$config">
                            @foreach($player->accessToken as $row)
                                <tr>
                                    <td>{!! $row->id !!}</td>
                                    <td>{!! $row->token !!}</td>
                                    <td>{!! $row->token_validity_period !!}</td>
                                    <td>{!! $row->status ? 'active' : 'no active' !!}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">
                                    <a href="{{ route('admin-new-token', $player->id) }}">
                                        <button class="btn btn-xs btn-default text-success mx-1 shadow"
                                                title="Add new token for user">
                                            <i class="fa fa-lg fa-fw fa-plus-circle"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        </x-adminlte-datatable>
                    </div>
                </div>
            @endif
            @if(count($playerPoints))
                <h3 class="mb-1 text-dark">Games of user</h3>
                <div class="card">
                    <div class="card-body">
                        @php
                            $heads = ['#', 'Points', 'Game date'];
                        @endphp
                        <x-adminlte-datatable id="table2" :heads="$heads" head-theme="light" theme="light" striped
                                              hoverable bordered :config="$config">
                            @foreach($playerPoints as $row)
                                <tr>
                                    <td>{!! $row->id !!}</td>
                                    <td>{!! $row->points !!}</td>
                                    <td>{!! $row->created_at !!}</td>
                                </tr>
                            @endforeach
                        </x-adminlte-datatable>
                        {{ $playerPoints->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.js') }}"></script>
@stop


