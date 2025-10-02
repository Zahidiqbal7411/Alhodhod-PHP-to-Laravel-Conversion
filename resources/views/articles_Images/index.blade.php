@extends('layouts.app')

@section('Main-content')

<!-- Custom Table CSS -->
<link rel="stylesheet" href="{{ asset('styling/article-images-table.css') }}">


<div class="pages-container">
    <!-- Header Section -->
    <div class="pages-header">
        <h1 class="pages-title">Article Images</h1>
        
        <a href="{{ route('articleimage.create') }}" class="add-page-btn">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Add New Article Image</span>
        </a>
    </div>

    <!-- Table Section -->
    <div class="pages-table-container">
        <table class="pages-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Article Image</th>
                    <th>Copy Image Path</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articleImages as $image)
                <tr>
                    <td>{{$image->id}}</td>
                    <td>
                        <img src="{{ asset($image->Image_path) }}" alt="Article Image"
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc;">
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 8px; justify-content: center;">
                            <input type="text" value="{{ asset($image->Image_path) }}" id="imgPath{{ $image->id }}"
                                readonly
                                style="width: 180px; font-size: 12px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
                            <button onclick="copyToClipboard('imgPath{{ $image->id }}')"
                                style="font-size: 12px; padding: 5px 10px; background-color: #10b981; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                Copy
                            </button>
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{route('articleimage.edit',$image->id)}}" class="edit-btn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                                <span>Edit</span>
                            </a>

                            <form action="{{route('articleimage.destroy',$image->id)}}" method="POST"
                                class="delete-form" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-btn" onclick="confirmDelete(this)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                <!-- Repeat rows dynamically -->
            </tbody>
        </table>
        
        <div class="d-flex justify-content-center align-items-center mt-4 flex-wrap gap-3">
                    <nav class="modern-pagination">
                        {!! $articleImages->links('pagination::bootstrap-5') !!}
                    </nav>
                </div>
    </div>

</div>


<script>
    function copyToClipboard(elementId) {
    var copyText = document.getElementById(elementId);
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
    document.execCommand('copy');
    alert('Copied: ' + copyText.value);
}

function confirmDelete(button) {
    if (confirm('Are you sure you want to delete this?')) {
        // No backend, so just alert
        alert('Deleted (demo only)');
    }
}
</script>

<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete this?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            background: '#ffffff'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading message
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Deleting...',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit the form
                button.closest('form').submit();
            }
        });
    }
</script>
@if(session('success'))
<script>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '{{ session("success") }}',
      timer: 2000,
      showConfirmButton: false,
      background: '#f0f8ff'
    });
</script>
@endif



<script>
    function copyToClipboard(elementId) {
    const input = document.getElementById(elementId);
    input.select();
    input.setSelectionRange(0, 99999); // For mobile
    document.execCommand("copy");

    // ✅ Show SweetAlert message
    Swal.fire({
        icon: 'success',
        title: 'Copied!',
        text: 'Your image path has been copied successfully.',
        timer: 2000,
        showConfirmButton: false,
        background: '#f0fdf4'
    });
}
</script>
@endsection



{{-- articlesimages/article_image/1751987541_Untitled design (6).png --}}