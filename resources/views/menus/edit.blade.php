@extends('layouts.app')

@section('Main-content')
    <!-- Add CSS Link -->
    <link rel="stylesheet" href="{{ asset('styling/page-form.css') }}">

    <div class="page-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h2>Edit Menu</h2>
                <p>Update your existing menu</p>
            </div>

            <!-- Display any errors -->
            @if(session('error'))
                <div class="alert alert-danger" style="background: #fee2e2; border: 1px solid #fecaca; color: #dc2626; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" style="background: #fee2e2; border: 1px solid #fecaca; color: #dc2626; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <ul style="margin: 0; padding-left: 1rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('menus.update', $menu->id)}}" method="POST" class="page-form" autocomplete="off">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label for="page_id">Select Page</label>
                        <select name="page_id" id="page_id" class="form-input">
                            <option value="">-- Choose Page --</option>
                            @foreach ($pages as $page)
                            <option value="{{ $page->id }}" {{ (old('page_id', $menu->page_id) == $page->id) ? 'selected' : '' }}>
                                {{ $page->page_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('page_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="menu_title">Menu Title</label>
                        <input type="text" id="menu_title" name="menu_title" value="{{$menu->menu_title}}" class="form-input" placeholder="Enter menu title" required>
                        @error('menu_title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-row languages">
                    <div class="form-group">
                        <label for="menu_en">
                            <span> English Menu </span>
                            <span class="lang-badge">EN</span>
                        </label>
                        <input type="text" id="menu_en" name="menu_en" value="{{ old('menu_en', $menu->menu_en) }}" class="form-input" placeholder="Menu in English" required>
                        @error('menu_en')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="menu_fr">
                            <span> French Menu </span>
                            <span class="lang-badge">FR</span>
                        </label>
                        <input type="text" id="menu_fr" name="menu_fr" value="{{ old('menu_fr', $menu->menu_fr) }}" class="form-input" placeholder="Menu en Français" required>
                        @error('menu_fr')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="menu_ar">
                            <span> Arabic Menu </span>
                            <span class="lang-badge">AR</span>
                        </label>
                        <input type="text" id="menu_ar" name="menu_ar" value="{{ old('menu_ar', $menu->menu_ar) }}" class="form-input" dir="rtl" placeholder="القائمة بالعربية" required>
                        @error('menu_ar')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="submit-btn" >
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Update Menu</span>
                    </button>
                    
                    <a href="{{ route('menus.index') }}" class="cancel-btn">
                        <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </div>

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
            text: 'Do you want to update this Menu?',
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
                    text: 'Please wait while we update the Menu...',
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

@endsection


