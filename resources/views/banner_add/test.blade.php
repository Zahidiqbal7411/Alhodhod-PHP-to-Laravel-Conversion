@extends('layouts.app')

@section('Main-content')
<!-- Add CSS Link -->

@push('styles')
<link rel="stylesheet" href="{{ asset('styling/banneradd.css') }}">

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
            
            <a  class="add-page-btn" data-bs-toggle="modal" data-bs-target="#advertisementModal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add New Advertisement</span>
            </a>

            <!--======== Advertisement Modal  ======== -->
            <div class="modal fade" id="advertisementModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Add New Advertisement</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="advertisementForm">
                                <!-- Ad Type Selection -->
                                <div class="form-section">
                                    <label for="adType">Ad Type</label>
                                    <div class="select-wrapper">
                                        <select id="adType" name="adType" class="form-control">
                                            <option value="" disabled selected>Select Ad Type</option>
                                            <option value="banner">Banner Add</option>
                                            <option value="subject">Subject Add</option>
                                            <option value="description">Description Add</option>
                                        </select>
                                        <div class="select-arrow"></div>
                                    </div>
                                </div>

                                <!-- Link Input -->
                                <div class="form-section">
                                    <label for="adLink">Ad Link</label>
                                    <input type="url" id="adLink" name="adLink" class="form-control"
                                        placeholder="https://example.com">
                                </div>

                                <!-- Title Input -->
                                <div class="form-section">
                                    <label for="adTitle">Ad Title</label>
                                    <input type="text" id="adTitle" name="adTitle" class="form-control"
                                        placeholder="Enter advertisement title">
                                </div>

                                <!-- Content Type Selection -->
                                <div class="form-section">
                                    <label>Content Type</label>
                                    <div class="toggle-group">
                                        <input type="radio" id="imageType" name="contentType" value="image" checked>
                                        <label for="imageType" class="toggle-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                <polyline points="21 15 16 10 5 21"></polyline>
                                            </svg>
                                            <span>Image Upload</span>
                                        </label>

                                        <input type="radio" id="textType" name="contentType" value="text">
                                        <label for="textType" class="toggle-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                                <path
                                                    d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z">
                                                </path>
                                            </svg>
                                            <span>Text Content</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Dynamic Content Area -->
                                <div id="contentArea">
                                    <!-- Image Upload (shown by default) -->
                                    <div class="form-section" id="imageUploadSection">
                                        <label for="adImage">Upload Image</label>
                                        <div class="upload-area">
                                            <input type="file" id="adImage" name="adImage" accept="image/*"
                                                class="upload-input">
                                            <label for="adImage" class="upload-label">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7">
                                                    </path>
                                                    <line x1="16" y1="5" x2="22" y2="5"></line>
                                                    <line x1="19" y1="2" x2="19" y2="8"></line>
                                                    <circle cx="9" cy="9" r="2"></circle>
                                                    <path d="M21 15l-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                                                </svg>
                                                <span>Click to upload or drag and drop</span>
                                                <span class="upload-hint">PNG, JPG, GIF up to 5MB</span>
                                            </label>
                                            <div class="image-preview hidden">
                                                <img id="imagePreview" src="#" alt="Preview" class="preview-image">
                                                <button type="button" class="remove-image-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Text Content (hidden by default) -->
                                    <div class="form-section hidden" id="textContentSection">
                                        <label for="adText">Ad Text Content</label>
                                        <textarea id="adText" name="adText" class="form-control" rows="4"
                                            placeholder="Enter your advertisement text content"></textarea>
                                    </div>
                                </div>

                                <!-- Multi-language Inputs -->
                                <div class="form-section">
                                    <label>Language Versions</label>
                                    <div class="language-tabs">
                                        <div class="tab-buttons">
                                            <button type="button" class="tab-btn active" data-lang="en">English</button>
                                            <button type="button" class="tab-btn" data-lang="fr">French</button>
                                            <button type="button" class="tab-btn" data-lang="ar">Arabic</button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="en-content">
                                                <input type="text" name="title_en" class="form-control"
                                                    placeholder="English title">
                                                <textarea name="content_en" class="form-control mt-2" rows="3"
                                                    placeholder="English content"></textarea>
                                            </div>
                                            <div class="tab-pane" id="fr-content">
                                                <input type="text" name="title_fr" class="form-control"
                                                    placeholder="French title">
                                                <textarea name="content_fr" class="form-control mt-2" rows="3"
                                                    placeholder="French content"></textarea>
                                            </div>
                                            <div class="tab-pane" id="ar-content">
                                                <input type="text" name="title_ar" class="form-control"
                                                    placeholder="Arabic title">
                                                <textarea name="content_ar" class="form-control mt-2" rows="3"
                                                    placeholder="Arabic content"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="cancel-btn" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="submit-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z">
                                            </path>
                                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                            <polyline points="7 3 7 8 15 8"></polyline>
                                        </svg>
                                        <span>Submit Advertisement</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                <tr>
                    <td>
                        <a href="{{ asset('uploads/sample.jpg') }}" target="_blank"
                            class="btn btn-sm btn-outline-primary">
                            View
                        </a>
                    </td>

                    <td>Sample Text</td>
                    <td><a href="https://example.com">example.com</a></td>
                    <td>42</td>
                    <td>Title EN</td>
                    <td>Title FR</td>
                    <td>Title AR</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td>
                        <div class="action-buttons">
                            <form action="" method="POST" class="delete-form"
                                style="display: inline-block; width: 100%; text-align: center;  padding-left: 55px;">
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
            </tbody>
        </table>
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




<script>
    // Modal trigger
    document.querySelector('.add-page-btn[span="Add New Advertisement"]').addEventListener('click', function(e) {
        e.preventDefault();
        // Initialize modal here (using Bootstrap or your preferred modal library)
        $('#advertisementModal').modal('show');
    });

    // Content type toggle
    document.querySelectorAll('input[name="contentType"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('imageUploadSection').classList.toggle('hidden', this.value !== 'image');
            document.getElementById('textContentSection').classList.toggle('hidden', this.value !== 'text');
        });
    });

    // Language tabs
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons and panes
            document.querySelectorAll('.tab-btn, .tab-pane').forEach(el => {
                el.classList.remove('active');
            });
            
            // Add active class to clicked button and corresponding pane
            this.classList.add('active');
            document.getElementById(`${this.dataset.lang}-content`).classList.add('active');
        });
    });

    // Image preview
    document.getElementById('adImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('imagePreview');
                preview.src = event.target.result;
                preview.parentElement.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove image
    document.querySelector('.remove-image-btn').addEventListener('click', function() {
        document.getElementById('adImage').value = '';
        document.getElementById('imagePreview').src = '#';
        this.parentElement.classList.add('hidden');
    });
</script>
@endsection