@extends('layouts.app')

@section('Main-content')
<link rel="stylesheet" href="{{ asset('styling/page-form.css') }}">

<style>
    .input-error-border {
        border: 1px solid #dc2626 !important;
    }

    .input-error-message {
        color: #dc2626;
        font-size: 14px;
        margin-top: 4px;
    }
</style>

<div class="page-wrapper" id="meta-container">
    <div class="form-container">
        <div class="form-header">
            <h2>Update Meta Tag</h2>
        </div>

        <form action="{{route('metatag.update',$metatags->id)}}" method="POST" autocomplete="off" class="page-form">
            @csrf
            @method('PUT')
            <div class="form-row">
                <!-- Page URL Field -->
                <div class="form-group">
                    <label for="meta_url">Page URL</label>
                    <input type="text" id="meta_url" name="meta_url"
                        class="form-input {{ $errors->has('meta_url') ? 'input-error-border' : '' }}"
                        placeholder="https://example.com" value="{{ old('meta_url', $metatags->url) }}" required>

                    @error('meta_url')
                    <div class="input-error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Meta Tag Code Field -->
                <div class="form-group">
                    <label for="meta_code">Meta Tag Code</label>
                    <input type="text" id="meta_code" name="meta_code"
                        class="form-input {{ $errors->has('meta_code') ? 'input-error-border' : '' }}"
                        placeholder='<meta name="description" content="...">'
                        value="{{ old('meta_code' ,$metatags->metatag_code) }}" required>

                    @error('meta_code')
                    <div class="input-error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn" onclick="return confirmCreate()">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Update Meta Tag</span>
                </button>

                <button type="reset" class="reset-btn">
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

<script>
    // Laravel server-side validation error flag
    @if ($errors->any())
        window.skipConfirm = true;
    @endif

    function confirmCreate() {
        if (window.skipConfirm) return true; // Laravel error already occurred

        const form = document.querySelector('form');
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

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
            return false;
        }

        // SweetAlert confirmation before submit
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to update this Meta Tag?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Create',
            cancelButtonText: 'Cancel',
            background: '#f0f8ff'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Creating...',
                    text: 'Please wait while we update the Meta Tag...',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    background: '#f0f8ff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                setTimeout(() => {
                    form.submit();
                }, 1000);
            }
        });

        return false;
    }
</script>
@endsection