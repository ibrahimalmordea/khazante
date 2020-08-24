@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Stores') }}</div>

                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <form method="POST" action="/AddNewstore" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-3 col-form-label text-md-right">{{ __('Store Name') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                        {{-- <option value="0">Admin</option>
                                        --}}
                                        <option value="1">Store</option>
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
                                    <input type="file" id="image" name="image" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Store Location</label>
                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control" name="location" value="" required=""
                                        autofocus="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('phone') }}</label>

                                <div class="col-md-8">
                                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" required>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="discription" class="col-md-3 col-form-label text-md-right">Store
                                    discription</label>
                                <div class="col-md-8">
                                    <textarea name="text" type="text" id="summernote"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Manage stores</div>
                    <div class="card-body">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        <table id="storetable">

                            <thead>
                                <tr>
                                    <th>
                                        Store image
                                    </th>
                                    <th>
                                        Store phone
                                    </th>
                                    <th>
                                        Store location
                                    </th>
                                    <th>
                                        action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($store as $store)
                                    <tr>
                                        <td style="width: 20%"><img src="{{ $store->image }}" alt="" width="100%"></td>
                                        <td>{{ $store->phone }}</td>
                                        <td>{{ $store->location }}</td>
                                        <td>
                                            <a href="view_all_product?id={{ $store->id }}" class="btn btn-info">View Prodects</a>
                                            <a href="edit_store?id={{ $store->id }}&useridfk={{ $store->useridfk }}"
                                                class="btn btn-primary">edit</a>
                                            <a href="delete_store?id={{ $store->id }}&useridfk={{ $store->useridfk }}"
                                                class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#storetable').DataTable();
            $('#summernote').summernote({
                toolbar: [
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
