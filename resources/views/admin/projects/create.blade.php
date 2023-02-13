@extends('admin.master')

@section('title', 'Create new Project')

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js" integrity="sha512-eV68QXP3t5Jbsf18jfqT8xclEJSGvSK5uClUuqayUbF5IRK8e2/VSXIFHzEoBnNcvLBkHngnnd3CY7AFpUhF7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    tinymce.init({
        selector: '.desc'
    })
</script>

@stop

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create new Project</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST">
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

            <div class="col-md-6">
                <div class="mb-3">
                    <label>English Description</label>
                    <textarea class="desc" name="description_en" placeholder="English Description">{{ old('description_en') }}</textarea>

                    @error('description_en')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>Arabic Description</label>
                    <textarea class="desc" name="description_ar" placeholder="Arabic Description">{{ old('description_ar') }}</textarea>
                    @error('description_ar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label>Budget</label>
                    <input type="text" placeholder="Budget" class="form-control @error('budget') is-invalid @enderror" name="budget" value="{{ old('budget') }}" />
                    @error('budget')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label>Time</label>
                    <input type="text" placeholder="Time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" />
                    @error('time')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option disabled selected value="" hidden> -- Select Category -- </option>
                        @foreach ($categories as $category)
                            {{-- <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->trans_name }}</option> --}}
                            <option @selected(old('category_id') == $category->id) value="{{ $category->id }}">{{ $category->trans_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-success"><i class="fas fa-save"></i> Add</button>
    </form>

@stop
