@extends('layouts.app')

@section('Main-content')
<!-- Add CSS Link -->

@push('styles')

<link rel="stylesheet" href="{{ asset('styling/banneradd.css') }}">
<link rel="stylesheet" href="{{ asset('styling/newbanneradd_Modal.css') }}">

@endpush

<div class="pages-container">

    <!-- ✅ TOP SECTION: Heading + Styled Buttons -->
    <div class="pages-header d-flex justify-content-between align-items-center">
        <!-- Left Side: Heading -->
        <h1 class="pages-title">Banner </h1>

        <!-- Right Side: Styled Buttons (movement style) -->
        <div class="d-inline-flex gap-2">
            <a href="#" class="add-page-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Banner Add</span>
            </a>
            <a href="#" class="add-page-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Subject Add</span>
            </a>
            <a href="#" class="add-page-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Description Add</span>
            </a>
            <a class="add-page-btn" data-bs-toggle="modal" data-bs-target="#advertisementModal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add New Advertisement</span>
            </a>
        </div>
    </div>

    <!-- ✅ TABLE SECTION -->
    <div id="banner-ads-table-wrapper">
        <table class="pages-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Text</th>
                    <th>Link</th>
                    <th>Clicks</th>
                    <th>En</th>
                    <th>Fr</th>
                    <th>Ar</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($adds as $add)
                <tr>
                    <!-- View Button with Modal Trigger -->
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                            class="btn btn-sm btn-outline-primary view-image-btn" data-id="{{ $add->id }}">
                            View
                        </button>
                    </td>





                    <!-- Ad Text -->
                    <td>{{ $add->ad_text }}</td>

                    <!-- Ad Link -->
                    <td><a href="{{ $add->ad_link }}" target="_blank">{{ parse_url($add->ad_link, PHP_URL_HOST) }}</a>
                    </td>

                    <!-- Click Count -->
                    <td>{{ $add->clicks ?? 0 }}</td>
                    {{-- ========start language ========== --}}

                    <td class="text-center">
                        {!! $add->en == 1 ? '<span class="text-success">✅</span>' : '<span class="text-danger">❌</span>'
                        !!}
                    </td>


                    <td class="text-center">
                        {!! $add->fr == 1 ? '<span class="text-success">✅</span>' : '<span class="text-danger">❌</span>'
                        !!}
                    </td>


                    <td class="text-center">
                        {!! $add->ar == 1 ? '<span class="text-success">✅</span>' : '<span class="text-danger">❌</span>'
                        !!}
                    </td>


                    <td class="text-center">
                        @if($add->ad_status == 1)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <!-- Action -->
                    <td>
                        <div class="action-buttons">
                            <form action="{{ route('ads.destroy', $add->id) }}" method="POST" class="delete-form"
                                style="display: inline-block; width: 100%; text-align: center; padding-left: 55px;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-btn" onclick="confirmDelete(this)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                {!! $adds->links('pagination::bootstrap-5') !!}
            </nav>
        </div>

    </div>
</div>
</div>

<!-- ✅ Delete Confirmation Script -->
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

                button.closest('form').submit();
            }
        });
    }
</script>






<!-- Modal for Image -->

<div class="modal fade" id="staticBackdrop" ...>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ad Preview</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="modal-body-content">
                <p>Loading...</p>
            </div>
        </div>
    </div>
</div>










{{-- ========= start modal in when click to ad new advertisement ======= --}}
<div class="modal fade" id="advertisementModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Advertisement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adForm" action="{{ route('ads.store') }}" method="POST" class="page-form"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Ad Type -->
                    <div class="ad-group">
                        <label class="ad-label" for="ad_type"><i class="bx bx-list-ul ad-icon"></i> Ad Type</label>
                        <select id="ad_type" name="ad_type" class="form-control" required>
                            <option value="" disabled {{ old('ad_type') ? '' : 'selected' }}>Select Ad Type</option>
                            <option value="1" {{ old('ad_type')==1 ? 'selected' : '' }}>Banner Ad</option>
                            <option value="2" {{ old('ad_type')==2 ? 'selected' : '' }}>Subject Ad</option>
                            <option value="3" {{ old('ad_type')==3 ? 'selected' : '' }}>Description Ad</option>
                        </select>
                        @error('ad_type') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Ad Link -->
                    <div class="ad-group">
                        <label class="ad-label" for="ad_link"><i class="bx bx-link ad-icon"></i> Ad Link</label>
                        <input type="url" id="ad_link" name="ad_link" class="form-control"
                            placeholder="https://example.com" value="{{ old('ad_link') }}" required>
                        @error('ad_link') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Ad Title -->
                    <div class="ad-group">
                        <label class="ad-label" for="ad_title"><i class="bx bx-text ad-icon"></i> Ad Title</label>
                        <input type="text" id="ad_title" name="ad_title" class="form-control" placeholder="Enter title"
                            value="{{ old('ad_title') }}" required>
                        @error('ad_title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Content: Ad URL or Image -->
                    <div class="ad-group">
                        <label class="ad-label"><i class="bx bx-pencil ad-icon"></i> Ad URL</label>
                        <input type="text" id="ad_url" name="ad_url" class="form-control" placeholder="Enter ad_url"
                            value="{{ old('ad_url') }}">
                        <div class="ad-divider">OR</div>
                        <input type="file" id="adImage" name="ad_image" class="d-none" accept="image/*">
                        <label for="adImage" class="btn btn-outline-secondary w-100">
                            <i class="bx bx-image-add me-2"></i> Upload Image
                        </label>
                        @error('ad_url') <small class="text-danger">{{ $message }}</small> @enderror
                        @error('ad_image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Language Options -->
                    <div class="ad-group">
                        <label class="ad-label"><i class="bx bx-globe ad-icon"></i> Languages</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="languages[]" id="langEn" value="1" {{
                                is_array(old('languages')) && in_array('1', old('languages')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="langEn">English</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="languages[]" id="langFr" value="2" {{
                                is_array(old('languages')) && in_array('2', old('languages')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="langFr">French</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="languages[]" id="langAr" value="3" {{
                                is_array(old('languages')) && in_array('3', old('languages')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="langAr">Arabic</label>
                        </div>

                        @error('languages') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>


                    <!-- Submit -->
                    <button type="submit" class="submit-btn" onclick="return confirmCreate()">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>Create Add Banner</span>
                    </button>

                    <button type="reset" class="reset-btn">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <span>Reset Form</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- model dta sotre in db sweet aler tmessage --}}


<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault(); // Stop default form submission

        const form = this;
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        // Step 1: Validate required fields
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#ef4444';
            } else {
                field.style.borderColor = '#e2e8f0';
            }
        });

        if (!isValid) {
            Swal.fire({
                title: 'Validation Error',
                text: 'Please fill in all required fields',
                icon: 'error',
                confirmButtonColor: '#ef4444'
            });
            return;
        }

        // Step 2: Confirm from user
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to create this Adds?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Create',
            cancelButtonText: 'Cancel',
            background: '#f0f8ff'
        }).then((result) => {
            if (result.isConfirmed) {
                // Optional: show a processing/loading dialog
                Swal.fire({
                    title: 'Creating...',
                    text: 'Please wait while we uploading the Adss For your Webiste...',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    background: '#f0f8ff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form to server (Laravel will handle redirect + session)
                setTimeout(() => {
                    form.submit(); // 🔁 This will actually submit the form
                }, 1000);
            }
        });

        
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.view-image-btn');
    const modalBody = document.getElementById('modal-body-content');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const adId = this.getAttribute('data-id');
            modalBody.innerHTML = '<p>Loading preview...</p>';

            fetch(`/ads/${adId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists && data.image_url) {
                        modalBody.innerHTML = `
                            <img src="${data.image_url}" alt="Ad Image" class="img-fluid rounded" style="max-height: 400px;">
                            <p class="mt-2"><strong>${data.title}</strong></p>
                        `;
                    } else {
                        modalBody.innerHTML = `
                            <div class="text-danger">
                                <i class="fas fa-image fa-3x"></i>
                                <p><strong>No image found for this advertisement.</strong></p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    modalBody.innerHTML = '<p class="text-danger">Error loading image preview.</p>';
                    console.error('Fetch error:', error);
                });
        });
    });
});
</script>
@endsection