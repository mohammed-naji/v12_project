@extends('admin.master')

@section('title', 'Create new Skill')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create new Skill</h1>

    <form action="{{ route('admin.skills.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>English Name</label>
                    <input type="text" placeholder="English Name" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en') }}" />
                    @error('name_en')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>Arabic Name</label>
                    <input type="text" placeholder="Arabic Name" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar') }}" />
                    @error('name_ar')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-success"><i class="fas fa-save"></i> Add</button>
    </form>

@stop
