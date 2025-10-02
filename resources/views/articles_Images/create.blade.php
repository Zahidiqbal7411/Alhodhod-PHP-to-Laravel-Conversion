 

 @extends('layouts.app')

 @section('Main-content')
 <!-- Add CSS Link -->
 <link rel="stylesheet" href="{{ asset('styling/page-form.css') }}">
 
 <div  class="page-wrapper">
     <div class="form-container">
         <div class="form-header">
             <h2>Create New Article Image</h2>
             <p>Add a new article image to your website</p>
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
 
        <form action="{{route('articleimage.store')}}" method="POST" autocomplete="off" class="page-form" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="article_image">Choose Article Image</label>
                    <input type="file" id="article_image" name="image" class="form-input" required>
                    @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-btn">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Create Image</span>
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

 {{-- sweet alert message   for  create pages and make with success in contorller--}}
 <!-- Create Confirmation Script -->
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
            text: 'Are you sure you want to create this Artilce Image?',
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
                    text: 'Please wait while we create the Article Image...',
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

 
 

 
 
 
 