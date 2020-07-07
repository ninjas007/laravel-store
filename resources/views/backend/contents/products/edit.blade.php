@extends('backend.template')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Products</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block">
                    <a href="{{ url('admin/products') }}" class="btn btn-danger font-weight-bold btn-shadow"><i class="fa fa-reply"></i> Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title"><i class="metismenu-icon pe-7s-menu"></i> Product Edit</h5>
                    <form method="POST" action="{{ url('admin/products/update', [$product->id]) }}">
                        @method('PUT')
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Product name" value="{{ $product->name }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Product price" value="{{ $product->price }}">

                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" placeholder="Product stock" value="{{ $product->stock }}">

                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ ($product->category_id == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Image</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-secondary" id="lfm" data-input="thumbnail" data-preview="holder"><i class="pe-7s-photo"></i> Choose</button>
                                </div>
                                <input id="thumbnail" class="form-control @error('path_image') is-invalid @enderror" type="text" name="path_image" placeholder="Choose your file / url image" value="{{ $product->path_image }}">
                            </div>
                            <img src="{{ $product->path_image }}" id="holder" style="margin-top:15px;max-height:100px;">

                            @error('path_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script type="text/Javascript">
    $('#lfm').filemanager('image');
</script>
@endsection