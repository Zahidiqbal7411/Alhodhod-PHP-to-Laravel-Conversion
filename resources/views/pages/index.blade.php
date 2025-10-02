@extends('layouts.app')

@section('Main-content')
    <!-- Add CSS Link -->
    <link rel="stylesheet" href="{{ asset('styling/pages.css') }}">

    <div class="pages-container">
        <!-- Header Section -->
        <div class="pages-header">
            <h1 class="pages-title">Pages</h1>
            <a href="{{ route('pages.create') }}" class="add-page-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add New Page</span>
            </a>
        </div>

        <!-- Table Section -->
        <div class="pages-table-container">
            <table class="pages-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page Name</th>
                        <th>Page Link</th>
                        <th>Page English</th>
                        <th>Page French</th>
                        <th>Page Arabic</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>{{$page->id}}</td>
                        <td>{{$page->page_name}}</td>
                        <td>{{$page->page_link}}</td>
                        <td>{{$page->page_en}}</td>
                        <td>{{$page->page_fr}}</td>
                        <td>{{$page->page_ar}}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{route('pages.edit',$page->id )}}" class="edit-btn">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                    <span>Edit</span>
                                </a>
                                
                                <form action="{{ route('pages.destroy', $page->id) }}" method="POST" class="delete-form" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-btn" onclick="confirmDelete(this)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          
                     <div class="d-flex justify-content-center align-items-center mt-4 flex-wrap gap-3">
            <nav class="modern-pagination">
                {!! $pages->links('pagination::bootstrap-5') !!}
            </nav>
        </div>
        </div>
    </div>

    <!-- Delete Confirmation Script -->
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
    
@endsection