@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">All Skills</h1>

    @if (session('msg'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif

    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($skills as $skill)
                <tr>
                    <td>{{ $skill->id }}</td>
                    <td>{{ $skill->trans_name }}</td>
                    <td>{{ $skill->created_at->format('F d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.skills.edit', $skill->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Are you sure ?!')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No Data Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop

@section('scripts')
<script>

    setTimeout(() => {
        $('.alert').fadeOut();
    }, 3000);

</script>
@stop
