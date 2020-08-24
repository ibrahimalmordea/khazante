@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit product') }}</div>

                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <form method="POST" action="/submit_edit_Product" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $Product->id }}">
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
                                        name="price" value="{{ $Product->price }}" required autocomplete="price" autofocus>

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
                                        name="name" value="{{ $Product->name }}" required autocomplete="name" autofocus>

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
                                    <input id="details" type="text" value="{{ $Product->details }}" class="form-control"
                                        name="details" value="" required="" autofocus="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Product Size</label>
                                <div class="col-md-8">
                                    <input id="size" type="text" class="form-control" value="{{ $Product->size }}"
                                        name="size" value="" required="" autofocus="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Product Color</label>
                                <div class="col-md-8">
                                    <input id="color" type="text" value="{{ $Product->color }}" class="form-control"
                                        name="color" value="" required="" autofocus="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-3 col-form-label text-md-right">Categories</label>

                                <div class="col-md-8">
                                    <select name="categories" class="form-control" id="categories">
                                        <option selected disabled="Categories">Categories</option>
                                        @foreach ($Categories as $Category)
                                            <option {{ $Category->id == $Product->categories ? 'selected' : '' }}
                                                value="{{ $Category->id }}">{{ $Category->name }}</option>
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
                                <label for="sub_categories" class="col-md-3 col-form-label text-md-right">Sub
                                    Categories</label>

                                <div class="col-md-8">
                                    <select name="sub_categories" class="form-control" id="subcategories">
                                        <option selected disabled>Sub Categories</option>
                                        @foreach ($Sub_Categories as $Sub_categories)
                                            <option {{ $Product->subcategories == $Sub_categories->id ? 'selected' : '' }}
                                                value="{{ $Sub_categories->id }}">{{ $Sub_categories->name }}</option>
                                        @endforeach
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
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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
                    url: "/getProduct2?categories=" + $('#categories').val(),
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
