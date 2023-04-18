@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
    <h1 class="m-0 text-dark">Admin panel</h1>
@stop
@php
    $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
                </button>';
    $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete"
    onclick="return confirm(\'Are you sure you want to delete the player?\')">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
                  </button>';
    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
                   </button>';
    $config['paging'] = false;
    $config['searching'] = false;
    $config['info'] = false;
    $heads = ['#', 'Name', 'Phone',  'Action'];
@endphp
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('add-player-form') }}" class="btn btn-primary float-right mb-3">Add
                        player</a>
                    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="light" theme="light" striped hoverable
                                          bordered :config="$config">
                        @foreach($players->items() as $player)
                            <tr>
                                <td>{!! $player->id !!}</td>
                                <td>{!! $player->username !!}</td>
                                <td>{!! $player->phone !!}</td>
                                <td>
                                    <nobr>
                                        <a href="{{ route('player-show', $player->id) }}">{!! $btnDetails !!}</a>
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
                        @endforeach
                    </x-adminlte-datatable>
                    {{ $players->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.js') }}"></script>
@stop
