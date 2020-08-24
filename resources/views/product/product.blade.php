@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Products') }}</div>

                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <form method="POST" action="/AddNewProduct" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $store->id }}">
                            <div class="form-group row">
                                <label for="image" class="col-md-3 col-form-label text-md-right">Product Image</label>
                                <div class="col-md-8">
                                    <input type="file" id="image" name="image" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price"
                                    class="col-md-3 col-form-label text-md-right">{{ __('Product price') }}</label>

                                <div class="col-md-8">
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-3 col-form-label text-md-right">{{ __('Product Name') }}</label>

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
                                <label for="name" class="col-md-3 col-form-label text-md-right">Product Details</label>
                                <div class="col-md-8">
                                    <input id="details" type="text" class="form-control" name="details" value="" required=""
                                        autofocus="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Product Size</label>
                                <div class="col-md-8">
                                    <input id="size" type="text" class="form-control" name="size" value="" required=""
                                        autofocus="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Product Color</label>
                                <div class="col-md-8">
                                    <input id="color" type="text" class="form-control" name="color" value="" required=""
                                        autofocus="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-3 col-form-label text-md-right">Categories</label>

                                <div class="col-md-8">
                                    <select name="categories" class="form-control" id="categories">
                                        <option selected disabled="Categories">Categories</option>
                                        @foreach ($Categories as $Category)
                                            <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-3 col-form-label text-md-right">Sub Categories</label>

                                <div class="col-md-8">
                                    <select name="sub_categories" class="form-control" id="subcategories">
                                        <option selected disabled>Sub Categories</option>
                                    </select>
                                    @error('type')
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
                                        Prodects image
                                    </th>
                                    <th>
                                        Prodects name
                                    </th>
                                    <th>
                                        Prodects size
                                    </th>
                                    <th>
                                        Prodects color
                                    </th>
                                    <th>
                                        action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Product as $Product)
                                     @if ($Product->storeidfk == $store->id)
                                    <tr>
                                        <td style="width: 20%"><img src="{{ $Product->image }}" alt="" width="100%"></td>
                                        <td>{{ $Product->name }}</td>
                                        <td>{{ $Product->size }}</td>
                                        <td>{{ $Product->color }}</td>
                                        <td>
                                            <a href="edit_Product?id={{ $Product->id }}" class="btn btn-primary">edit</a>
                                            <a href="delete_Product?id={{ $Product->id }}" class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                    @endif
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
            $("#categories").on('change', function() {
                $.ajax({
                    url: "/getProduct?categories=" + $('#categories').val(),
                    success: function(result) {
                        console.log(result);
                        var subcategories = [];
                        result.forEach(subcategoriess => {
                            subcategories.push({
                                text: subcategoriess.name,
                                value: subcategoriess.id
                            });
                        });
                        var $el = $("#subcategories");
                        $el.empty();
                        $.each(subcategories, function(key, value) {
                            $el.append($("<option></option>")
                                .attr("value", value.value).text(value.text));
                        });
                    }
                });
            });
        });

    </script>
@endsection
