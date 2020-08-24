@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Sub_Categories') }}</div>

                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <form method="POST" action="/AddNewSub_Categories" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Sub_Categories name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Categories name') }}</label>

                                <div class="col-md-6">
                                    <select id="Categories" placeholder="Categories"
                                        class="form-control @error('Categories') is-invalid @enderror" name="Categories"
                                        required>
                                        <option selected disabled="Categories">Categories</option>
                                        @foreach ($Categories as $Category)
                                            <option value="{{ $Category->id }}">{{ $Category->name }}</option>
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
                                        {{ __('Add') }}
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
                    <div class="card-header">Manage profiles</div>
                    <div class="card-body">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        <table id="Sub_Categoriestable">

                            <thead>
                                <tr>
                                    <th>
                                        Sub_Categories number
                                    </th>
                                    <th>
                                        Sub_Categories name
                                    </th>
                                    <th>
                                        Categories name
                                    </th>
                                    <th>
                                        action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Sub_Categories as $Sub_Categories)
                                    <tr>
                                        <td>{{ $Sub_Categories->id }}</td>
                                        <td>{{ $Sub_Categories->name }}</td>
                                        <td>{{ $Sub_Categories->Category }}</td>
                                        <td>
                                            <a href="edit_Sub_Categories?id={{ $Sub_Categories->id }}"
                                                class="btn btn-primary">edit</a>
                                            <a href="delete_Sub_Categories?id={{ $Sub_Categories->id }}"
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
            $('#Sub_Categoriestable').DataTable();
        });

    </script>
@endsection
