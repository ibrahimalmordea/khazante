@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($Product2 as $Product)
                <div class="col-md-4 mt-3">
                    <a href="view_product?id={{ $Product->id }}">
                        <div class="card">
                            <img class="card-img-top" src="{{ $Product->image }}" alt="Card image cap"
                                style="height: 200px">
                            <div class="card-body" style="text-align: center;height: 17vh">
                                <h4 class="card-title">{{ $Product->name }}</h4>
                                <p class="card-text">{!! \Illuminate\Support\Str::limit($Product->details, 50, $end = '...')
                                    !!}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
