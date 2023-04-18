@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
    <h1 class="m-0 text-dark">Create player</h1>
@stop
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Player create form</h3>
        </div>
        <form method="post" action="{{ route('admin-player-create') }}">
            @csrf
            <div class="card-body">
                <x-adminlte-input name="username" label="Username" value="{{ old('username') }}"
                                  placeholder="Username">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input name="phone" label="Phone" value="{{ old('phone') }}" placeholder="Phone">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-phone"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-button class="btn-flat" type="submit" label="Create" theme="success"
                                   icon="fas fa-lg fa-save"/>
                <x-adminlte-button class="btn-flat" type="reset" label="Reset" theme="outline-danger"
                                   icon="fas fa-lg fa-trash"/>
                <a href="{{ route('admin') }}">
                    <x-adminlte-button class="btn-flat" label="Back" theme="info" icon="fas fa-arrow-circle-left"/>
                </a>
            </div>
        </form>
@endsection
