@extends('layouts.app')

@section('Main-content')
<!-- Add CSS Link -->
<link rel="stylesheet" href="{{ asset('styling/pages.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Profile Edit Container */
    .profile-edit-container {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
        text-align: center;
    }

    /* Profile Header */
    .profile-edit-header {
        margin-bottom: 2rem;
    }

    .profile-edit-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .profile-edit-subtitle {
        color: #64748b;
        font-size: 1rem;
    }

    /* Profile Image */
    .profile-image-edit-container {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        overflow: hidden;
        border: 5px solid #f1f5f9;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin: 0 auto 2rem;
        position: relative;
    }

    .profile-image-edit {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .profile-image-edit:hover {
        transform: scale(1.05);
    }

    .default-icon-edit {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        color: #cbd5e1;
        font-size: 4rem;
    }

    /* Update Button */
    .update-image-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 2rem;
        background: #3b82f6;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        margin-top: 1rem;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
    }

    .update-image-btn:hover {
        background: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
    }

    /* Hidden Upload Form */
    .upload-form-edit {
        display: none;
        margin-top: 2rem;
        text-align: center;
    }

    .file-input-wrapper-edit {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .file-input-label-edit {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background: #f8fafc;
        color: #1e293b;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px dashed #cbd5e1;
    }

    .file-input-label-edit:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }

    .file-input-wrapper-edit input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .image-preview-edit {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin: 1rem auto;
        display: none;
        border: 3px solid #e2e8f0;
    }

    .form-actions-edit {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 1rem;
    }

    .submit-btn-edit {
        padding: 0.75rem 1.5rem;
        background: #10b981;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .submit-btn-edit:hover {
        background: #059669;
        transform: translateY(-2px);
    }

    .cancel-btn-edit {
        padding: 0.75rem 1.5rem;
        background: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .cancel-btn-edit:hover {
        background: #f1f5f9;
    }

    /* Status Message */
    .status-message-edit {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        text-align: center;
        margin-top: 1.5rem;
        animation: fadeIn 0.3s ease-out;
    }

    .success-edit {
        background: #d1fae5;
        color: #065f46;
    }

    .error-edit {
        background: #fee2e2;
        color: #991b1b;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="profile-edit-container">
    <!-- Profile Header -->
    <div class="profile-edit-header">
        <h1 class="profile-edit-title">Update Profile Image</h1>
        <p class="profile-edit-subtitle">Upload a new image for your profile</p>
    </div>

    <!-- Current Profile Image -->
    <div class="profile-image-edit-container">
        @if($user_imgs->profile_image)
        <img src="{{ asset($user_imgs->profile_image) }}" class="profile-image-edit" alt="Profile Image">
        @else
        <div class="default-icon-edit">
            <i class="fas fa-user"></i>
        </div>
        @endif
    </div>

    <!-- Update Button -->
    <button class="update-image-btn" id="showUploadFormBtn">
        <i class="fas fa-camera"></i>
        Update Profile Image
    </button>

    <!-- Upload Form (Hidden by default) -->
    <form class="upload-form-edit" id="uploadForm" action="{{route('profile.update',$user_imgs->id)}}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="file-input-wrapper-edit">
            <label class="file-input-label-edit" id="fileInputLabel">
                <i class="fas fa-cloud-upload-alt"></i> Choose New Image
                <input type="file" name="profile_image" id="profileImageInput" accept="image/*">
            </label>
        </div>

        <!-- Image preview -->
        <img id="imagePreview" class="image-preview-edit" src="#" alt="Preview">

        <div class="form-actions-edit">
            <button type="button" class="cancel-btn-edit" id="cancelUploadBtn">
                Cancel
            </button>
            <button type="submit" class="submit-btn-edit" id="uploadBtn" disabled>
                Save Changes
            </button>
        </div>
    </form>

    <!-- Status Message -->
    @if (session('success'))
    <div class="status-message-edit success-edit">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="status-message-edit error-edit">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif
</div>

<script>
    // DOM Elements
    const showUploadFormBtn = document.getElementById('showUploadFormBtn');
    const uploadForm = document.getElementById('uploadForm');
    const cancelUploadBtn = document.getElementById('cancelUploadBtn');
    const profileImageInput = document.getElementById('profileImageInput');
    const imagePreview = document.getElementById('imagePreview');
    const uploadBtn = document.getElementById('uploadBtn');
    const fileInputLabel = document.getElementById('fileInputLabel');

    // Toggle upload form visibility
    showUploadFormBtn.addEventListener('click', function() {
        uploadForm.style.display = 'block';
        this.style.display = 'none';
    });

    cancelUploadBtn.addEventListener('click', function() {
        uploadForm.style.display = 'none';
        showUploadFormBtn.style.display = 'inline-flex';
        profileImageInput.value = '';
        imagePreview.style.display = 'none';
        uploadBtn.disabled = true;
        fileInputLabel.innerHTML = `<i class="fas fa-cloud-upload-alt"></i> Choose New Image`;
    });

    // Image preview functionality
    profileImageInput.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(event) {
                imagePreview.src = event.target.result;
                imagePreview.style.display = 'block';
                uploadBtn.disabled = false;
                fileInputLabel.innerHTML = `<i class="fas fa-check-circle"></i> Image Selected`;
            };
            
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>

<!-- Include SweetAlert2 for beautiful alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection