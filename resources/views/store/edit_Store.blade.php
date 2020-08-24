@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Stores') }}</div>

                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <form method="POST" action="/submit_edit_store" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $store->id }}">
                            <input type="hidden" name="ids" value="{{ $store->useridfk }}">

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-3 col-form-label text-md-right">{{ __('Store Name') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name"  value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $user->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-3 col-form-label text-md-right">User Role</label>

                                <div class="col-md-8">
                                    <select name="type" class="form-control">
                                        <option {{ $store->type == '1' ? 'selected' : '' }} value="1">Store</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-3 col-form-label text-md-right">Store Image</label>
                                <div class="col-md-8">
                                    <input type="file" id="image" value="{{ $store->image }}" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-md-3 col-form-label text-md-right">Store Location</label>
                                <div class="col-md-8">
                                    <input id="location" name="location" type="text" value="{{ $store->location }}" class="form-control" name="location" value="" required=""
                                        autofocus="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('phone') }}</label>

                                <div class="col-md-8">
                                    <input id="phone" type="phone" value="{{ $store->phone }}" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" required>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="desciption" class="col-md-3 col-form-label text-md-right">Store
                                    desciption</label>
                                <div class="col-md-8">
                                    <textarea name="text" id="summernote">{!! $store->description !!}</textarea>
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
        <script>
            $(document).ready(function() {
                $('#storetable').DataTable();
                $('#summernote').summernote({
                    toolbar: [
                        // [groupName, [list of button]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['height', ['height']]
                    ]
                });
            });

        </script>
    @endsection
