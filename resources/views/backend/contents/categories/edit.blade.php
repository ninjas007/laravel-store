@extends('backend.template')
@section('content')
<div class="app-main__inner">
    <form method="POST" action="{{ url('admin/categories/update', [$category->uuid]) }}">
        @method('PUT')
        @csrf
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-menu icon-gradient bg-happy-itmeo">
                        </i>
                    </div>
                    <div>Categories</div>
                </div>
                <div class="page-title-actions">
                    <button type="submit" data-toggle="tooltip" title="Save" data-placement="bottom" class="btn-shadow mr-3 btn btn-primary font-weight-bold">Save
                    </button>
                    <div class="d-inline-block">
                        <a href="{{ url('admin/categories') }}" class="btn btn-danger font-weight-bold btn-shadow"><i class="fa fa-reply"></i> Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="metismenu-icon pe-7s-plus"></i> Edit Category</h5>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Category name" value="{{ $category->name }}" onkeyup="clearError()">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sort_list">Sort List</label>
                            <input type="number" class="form-control" name="sort_list" id="sort_list" placeholder="Sort list" value="{{ $category->sort_list }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" placeholder="Category slug" value="{{ $category->slug }}">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection