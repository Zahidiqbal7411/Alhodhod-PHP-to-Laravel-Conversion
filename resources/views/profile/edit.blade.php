<!-- Profile Image Upload Modal -->
<div class="modal fade" id="profileImageModal" tabindex="-1" aria-labelledby="profileImageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      @method('PATCH')
      <div class="modal-header">
        <h5 class="modal-title">Update Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        @if(auth()->user()->profile_image)
          <img src="{{ asset('uploadimage/profile_image' . auth()->user()->profile_image) }}" class="img-thumbnail mb-3" style="width: 120px; height: 120px;">
        @else
          <img src="{{ asset('default-user.png') }}" class="img-thumbnail mb-3" style="width: 120px; height: 120px;">
        @endif

        <input type="file" name="profile_image" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>
