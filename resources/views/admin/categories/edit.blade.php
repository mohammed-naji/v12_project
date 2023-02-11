@extends('admin.master')

@section('title', 'Edit Category')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>English Name</label>
                    <input type="text" placeholder="English Name" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en', $category->en_name) }}" />
                    @error('name_en')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>Arabic Name</label>
                    <input type="text" placeholder="Arabic Name" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar', $category->ar_name) }}" />
                    @error('name_ar')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
    </form>

@stop
