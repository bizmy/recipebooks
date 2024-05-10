@extends('layout')

@section('title', 'Add Recipe')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Add Recipe
                    <a href="{{ url('recipes') }}" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('recipes/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Ingredients</label>
                        <input type="text" name="ingredients" class="form-control" value="{{ old('ingredients') }}" />
                        @error('ingredients') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Link</label>
                        <input type="text" name="link" class="form-control" value="{{ old('link') }}" />
                        @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Categories</label>
                            <select class="form-control" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                            </select>
                        @error('categories') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Upload File/Image</label>
                        <input type="file" name="image" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
