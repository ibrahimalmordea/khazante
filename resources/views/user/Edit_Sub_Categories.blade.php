@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Sub_Categories') }}</div>

                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <form method="POST" action="/submit_edit_Sub_Categories">
                            @csrf
                            <input type="hidden" name="id" value="{{ $Sub_Categories->id }}">

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Sub_Categories name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" value="{{ $Sub_Categories->name }}"
                                        class="form-control @error('name') is-invalid @enderror" name="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Category"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Categories name') }}</label>

                                <div class="col-md-6">
                                    <select id="Categories" placeholder="Categories"
                                        class="form-control @error('Categories') is-invalid @enderror" name="Categories" required>
                                        @foreach ($Categories as $Category)
                                            <option {{ $Category->id == $Sub_Categories->Category ? 'selected' : ''}} value="{{ $Category->id }}">{{ $Category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
