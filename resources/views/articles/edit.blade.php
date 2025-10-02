@extends('layouts.app')

@section('Main-content')
<!-- Add CSS Link -->
<link rel="stylesheet" href="{{ asset('styling/page-form.css') }}">

<div class="page-wrapper">
    <div class="form-container">
        <div class="form-header">
            <h2>Edit Article</h2>
            <p>Update your existing article</p>
        </div>

        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data"
            autocomplete="off" class="page-form">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="language">Language</label>
                    <select name="language" id="language" class="form-input" required>
                        <option value="">-- Select Language --</option>
                        <option value="en" {{ $article->language == 'en' ? 'selected' : '' }}>English</option>
                        <option value="fr" {{ $article->language == 'fr' ? 'selected' : '' }}>French</option>
                        <option value="ar" {{ $article->language == 'ar' ? 'selected' : '' }}>Arabic</option>
                    </select>
                    @error('language') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label for="article_title">Article Title</label>
                    <input type="text" id="article_title" name="article_title" value="{{ $article->article_title }}"
                        class="form-input" placeholder="Enter article title" required>
                    @error('article_title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="metatag">Meta Tag</label>
                    <input type="text" id="metatag" name="metatag" value="{{ $article->metatag }}" class="form-input"
                        placeholder="Meta tag, SEO keywords">
                    @error('metatag') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label for="article_image">Upload Image</label>
                    <input type="file" id="article_image" name="article_image" class="form-input" accept="image/*">

                    @if(!empty($article->article_image))
                    <div class="image-preview-wrapper" style="margin-top: 10px;">
                        <img id="previewImage" src="{{ asset($article->article_image) }}" alt="Current Image"
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd;">
                    </div>
                    @else
                    <div class="image-preview-wrapper" style="margin-top: 10px;">
                        <img id="previewImage" src="#" alt="Preview"
                            style="display: none; width: 120px; height: 120px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd;">
                    </div>
                    @endif





                    @error('article_image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="menu_id">Menu</label>
                    <select name="menu_id" id="menu_id" class="form-input">
                        <option value="">-- Choose Menu --</option>
                        @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" {{ $article->menu_id == $menu->id ? 'selected' : '' }}>{{
                            $menu->menu_title }}</option>
                        @endforeach
                    </select>
                    @error('menu_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label for="show_on_home">Show on Home Page</label>
                    <div style="margin-top: 0.5rem;">
                        <input type="checkbox" id="show_on_home" name="show_on_home_page" value="1" {{
                            $article->show_on_home_page ? 'checked' : '' }} style="margin-right: 0.5rem;">
                        <label for="show_on_home" style="font-weight: normal; margin: 0;">Yes</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group" style="flex: 1;">
                    <label for="editor_full">Content</label>
                    <textarea id="editor_full" name="content" class="form-textarea" rows="10"
                        placeholder="Enter article content" required>{!! $article->content !!}</textarea>

                    @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Update Article</span>
                </button>
                <a href="{{ route('articles.index') }}" class="reset-btn"
                    style="margin-left: 10px; text-decoration: none;">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    <span>Back to Articles</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')

 <script>
    // Initialize CKEditor
    let editor = CKEDITOR.replace('editor_full', {
        height: 400,
        contentsLangDirection: '{{ $article->language === "ar" ? "rtl" : "ltr" }}',
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

    // Direction switch on language change
    document.getElementById('language').addEventListener('change', function () {
        const lang = this.value;
        if (lang === 'ar') {
            editor.editable().setAttribute('dir', 'rtl');
        } else {
            editor.editable().setAttribute('dir', 'ltr');
        }
    });

    // Validate required fields
    document.querySelector('.page-form').addEventListener('submit', function(e) {
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.editor_full) {
            CKEDITOR.instances.editor_full.updateElement();
        }

        const requiredFields = this.querySelectorAll('[required]');
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
            e.preventDefault();
            Swal.fire({
                title: 'Validation Error',
                text: 'Please fill in all required fields',
                icon: 'error',
                confirmButtonColor: '#ef4444'
            });
        }
    });
</script>

{{-- SweetAlert2 Success Message --}}
<script>
    document.querySelector('.page-form').addEventListener('submit', function (e) {
        e.preventDefault(); // Stop default for now

        const form = this;
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        // ✅ Validate required fields
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

        // ✅ Ask for confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to update this Article?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'Cancel',
            background: '#f0f8ff'
        }).then((result) => {
            if (result.isConfirmed) {
                // ✅ Show processing message
                Swal.fire({
                    title: 'Updating...',
                    text: 'Please wait while we update the Article...',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    background: '#f0f8ff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // ✅ Let the form submit *after* a small delay to show loader
                setTimeout(() => {
                    form.submit(); // Real submit now to Laravel controller
                }, 1000);
            }
        });
    });
</script>





<style>
     .image-preview-wrapper img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
        margin-top: 5px;
    }
</style>


{{-- this is the image artilce to show --}}


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

@endsection