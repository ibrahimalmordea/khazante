@extends('layouts.app')

@section('content')

    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-11" style="margin: 3% 0%; text-align: center">
                        <h1 style="font-weight: bold;">{{ $Product->name }}</h1>
                    </div>
                </div>
                <div class="row">
                    <img class="col-md-11" src="{{ $Product->image }}" alt="news image" style="height: 75vh">
                </div>
            <br>
                <div class="row">
                    <div class="col-md-11">
                        <p>{!! $Product->details !!}</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
