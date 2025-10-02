@extends('layouts.app')

@section('Main-content')
<!-- Add CSS Link -->
<link rel="stylesheet" href="{{ asset('styling/page-form.css') }}">

<div class="page-wrapper">
    <div class="form-container">
        <div class="form-header">
            <h2>Create New Article</h2>
            <p>Add a new article to your website</p>
        </div>

        <!-- Display any errors -->
        @if(session('error'))
        <div class="alert alert-danger"
            style="background: #fee2e2; border: 1px solid #fecaca; color: #dc2626; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger"
            style="background: #fee2e2; border: 1px solid #fecaca; color: #dc2626; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            <ul style="margin: 0; padding-left: 1rem;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="language_select">Language</label>
                    <select name="language" id="language_select" class="form-input" required>
                        <option value="">-- Select Language --</option>
                        <option value="en" {{ old('language')=='en' ? 'selected' : '' }}>English</option>
                        <option value="fr" {{ old('language')=='fr' ? 'selected' : '' }}>French</option>
                        <option value="ar" {{ old('language')=='ar' ? 'selected' : '' }}>Arabic</option>
                    </select>
                    @error('language') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="article_title">Article Title</label>
                    <input type="text" id="article_title" name="article_title" class="form-input"
                        placeholder="Enter article title" value="{{old('article_title')}}" required>
                    @error('article_title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="metatag">Meta Tag</label>
                    <input type="text" id="metatag" name="metatag" class="form-input"
                        placeholder="Meta tag, SEO keywords" value="{{old('metatag')}}">
                    @error('metatag') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="article_image">Upload Image</label>
                    <input type="file" id="article_image" name="article_image" class="form-input" accept="image/*">

                    {{-- =======Start imgage priviw code ======= --}}
                    <!-- Preview container -->
                    <div class="image-preview-wrapper">
                        <img id="previewImage" src="#" alt="Preview">
                    </div>

                    {{-- =======End imgage priviw code ======= --}}

                    @error('article_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="menu_id">Menu</label>
                    <select name="menu_id" id="menu_id" class="form-input">
                        <option value="">-- Choose Menu --</option>
                        @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" {{ old('menu_id')==$menu->id ? 'selected' : '' }}>
                            {{ $menu->menu_title }}
                        </option>
                        @endforeach
                    </select>
                    @error('menu_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="show_on_home">Show on Home Page</label>
                    <div style="margin-top: 0.5rem;">
                        <input type="checkbox" id="show_on_home" name="show_on_home_page" value="1" {{
                            old('show_on_home_page') ? 'checked' : '' }} style="margin-right: 0.5rem;">
                        <label for="show_on_home" style="font-weight: normal; margin: 0;">Yes</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group" style="flex: 1;">
                    <label for="editor_full">Content</label>
                    <textarea name="content" id="editor_full" class="form-textarea" rows="10"
                        placeholder="Enter article content" required>{{ old('content') }}</textarea>
                    @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Create Article</span>
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

{{-- ==== start sweet alert message first asekd and secnd proces and third is successs message and last if without fill the form
 then  show message error --}}
<script>
document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault(); // Stop form submission
    const form = this;
    const requiredFields = form.querySelectorAll('[required]');
    let firstMissingField = null;
    let isValid = true;

    // Step 1: Validate and collect first missing field
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.style.borderColor = '#ef4444';
            if (!firstMissingField) firstMissingField = field;
        } else {
            field.style.borderColor = '#e2e8f0';
        }
    });

    if (!isValid) {
        // Focus on the first missing field
        if (firstMissingField) firstMissingField.focus();

        // SweetAlert for specific feedback
        Swal.fire({
            title: 'Missing Required Field',
            text: firstMissingField.getAttribute('placeholder') || 'Please fill in required input',
            icon: 'error',
            confirmButtonColor: '#ef4444'
        });
        return;
    }

    // Step 2: Confirm from user
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to create this article?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Create',
        cancelButtonText: 'Cancel',
        background: '#f0f8ff'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Creating...',
                text: 'Please wait...',
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
});
</script>


  {{-- Show SweetAlert success message after redirect --}}
@if (session('success'))
  <script>
    Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: @json(session('success')),
            showConfirmButton: false,
            timer: 2000,
            background: '#f0f8ff'
        });
  </script>
@endif
{{-- ==== End sweet alert message first asekd and secnd proces and third is successs message and last if without fill the form
 then  show message error --}}



{{--========== start CKEditor Script {{--========== --}}
<script>
    // Initialize CKEditor
    let editor = CKEDITOR.replace('editor_full', {
        height: 400,
        contentsLangDirection: 'ltr', // default
        extraPlugins: 'colorbutton,font,justify,print,sourcearea,find,div,iframe,templates',
        removePlugins: 'elementspath',
        resize_enabled: true,
        toolbar: [
            { name: 'document', items: [ 'Source', '-', 'NewPage', 'Templates', 'Print' ] },
            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
            '/',
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
                                          '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'SpecialChar', 'Iframe' ] },
            '/',
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
        ]
    });

    // Detect language selection and change editor direction
    document.getElementById('language_select').addEventListener('change', function () {
        const lang = this.value;

        if (lang === 'ar') {
            editor.editable().setAttribute('dir', 'rtl');
        } else {
            editor.editable().setAttribute('dir', 'ltr');
        }
    });
</script>
{{--========== End CKEditor Script {{--========== --}}

{{-- =================== Start artilce image preview code =================== --}}
<style>
    /* Add this to your page-form.css */
.image-preview-wrapper {
    margin-top: 10px;
}

.image-preview-wrapper img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #ddd;
    display: none; /* Hidden by default */
}
</style>
@push('article-image-prview')
<script>
   document.getElementById('article_image').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('previewImage');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
{{-- =================== End artilce image preview code =================== --}}

@endsection