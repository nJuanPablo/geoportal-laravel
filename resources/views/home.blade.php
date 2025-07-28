@extends('layouts.app')
@section('title', 'Login')

@section('css')
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
@endsection

@section('content')
   
    <div class="bg-personalizado">
        <div class="col-md-11 mx-auto">
            {{-- <br> --}}
            <div class="">
                <h1 class="text-center tipografia">Visor Geográfico</h1>
                {{-- <p>{{ auth()->user()->name ?? auth()->user()->username}}!</p> --}}
            </div>  
            <div class="mx-auto">
                <div id="map" style="width: 100%; height: 800px;"></div>
            </div>
        </div>
    </div>

    {{-- @guest
        <div class="container"></div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1>HOME</h1>
                    <p>You are not logged in.</p>
                </div>  
            </div>
        </div>
    @endguest --}}
@endsection


@push('javascripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin="">
    </script>
    <script>
        var map = L.map('map').setView([4.690839, -74.091074], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);
    </script>
@endpush