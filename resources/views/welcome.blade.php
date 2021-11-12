@extends('layouts.app')
@section('body')

    <div class="container">
        <div class="text-center my-lg-3">
            <h1 class="font-weight-bold">Autos disponibles para ti</h1>
            <span class="text-black-50">Encuentra el auto perfecto al mejor precio del mercado</span>
        </div>

        <cars-component :cars="{{$cars}}"></cars-component>
    </div>
@stop


