@extends('layouts.app')

@section('Main-content')
<!-- Add CSS Link -->
<link rel="stylesheet" href="{{ asset('styling/page-form.css') }}">

<div class="page-wrapper">
    <div class="form-container">
        <div class="form-header">
            <h2>Create New Page</h2>
            <p>Add a new page to your website</p>
        </div>

        <form action="{{ route('pages.store') }}" method="POST" autocomplete="off" class="page-form"> 
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="page_name">Page Name</label>
                    <input type="text" id="page_name" name="page_name" class="form-input" placeholder="Enter page name"
                        required>
                </div>

                <div class="form-group">
                    <label for="page_link">Page Link</label>
                    <input type="text" id="page_link" name="page_link" class="form-input" placeholder="Enter page link"
                        required>
                </div>
            </div>

            <div class="form-row languages">
                <div class="form-group">
                    <label for="page_en">
                        <span>Page English </span>
                        <span class="lang-badge">EN</span>
                    </label>
                    <input type="text" id="page_en" name="page_english" class="form-input"
                        placeholder="Enter English content" required>
                </div>

                <div class="form-group">
                    <label for="page_fr">
                        <span>Page French </span>
                        <span class="lang-badge">FR</span>
                    </label>
                    <input type="text" id="page_fr" name="page_french" class="form-input"
                        placeholder="Entrez le contenu en français" required>
                </div>

                <div class="form-group">
                    <label for="page_ar">
                        <span>Page Arabic </span>
                        <span class="lang-badge">AR</span>
                    </label>
                    <input type="text" id="page_ar" name="page_arabic" class="form-input arabic-input"
                        placeholder="أدخل المحتوى بالعربية" required style="direction: rtl; text-align: right;">
                </div>
            </div>

            <div class="form-actions">

               <button type="submit" class="submit-btn" onclick="return confirmCreate()">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Create Menu</span>
                    </button>

                <button type="reset" class="reset-btn" >
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    <span>Reset Form</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Create Confirmation Script -->
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
            text: 'Are you sure you want to create this Page?',
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
                    text: 'Please wait while we create the Page...',
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


@endsection