@extends('admin.master')

@section('title', 'Create new Category')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Site Settings</h1>

    <form action="{{ route('admin.settings_data') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label>Site Name</label>
                    <input type="text" placeholder="Site Name" class="form-control @error('site_name') is-invalid @enderror" name="site_name" value="{{ old('site_name', settings()->get('site_name')) }}" />
                    @error('site_name')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>

        </div>
        <button class="btn btn-success"><i class="fas fa-save"></i> Save</button>
    </form>

@stop
