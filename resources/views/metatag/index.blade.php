@extends('layouts.app')

@section('Main-content')
<link rel="stylesheet" href="{{ asset('styling/metatag.css') }}">

<style>
.modal {
    position: fixed;
    z-index: 9999;
    padding-top: 80px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    margin: auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 70%;
    max-width: 700px;
    position: relative;
}

.close-modal {
    position: absolute;
    right: 20px;
    top: 10px;
    cursor: pointer;
    font-size: 20px;
}

.read-more-btn {
    color: #3b82f6;
    background: none;
    border: none;
    cursor: pointer;
    text-decoration: underline;
}
</style>

<div id="meta-container">
    <div id="meta-header">
        <h1 id="meta-title">Meta Tags</h1>

        <div id="meta-search-box">
            <form method="GET" action="">
                <input type="text" name="search" class="meta-search-input" placeholder="Search by URL..."
                    value="{{ request('search') }}">
                <button type="submit" class="meta-search-btn">Search</button>
            </form>
        </div>

        <div class="pages-header">
            <a href="{{ route('metatag.create') }}" class="add-page-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add New Meta tag</span>
            </a>
        </div>
    </div>

    <div id="meta-table-container">
        <table id="meta-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>URL</th>
                    <th>Meta Tag Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($metatags as $meta)
                <tr>
                    <td>{{ $meta->id }}</td>
                    <td>{{ $meta->url }}</td>
                    <td>
                        @if(strlen($meta->metatag_code) > 80)
                            {{ Str::limit($meta->metatag_code, 80) }}
                            <button class="read-more-btn" onclick="showMetaModal({{ $meta->id }})">Read More</button>
                            <div id="meta-code-{{ $meta->id }}" style="display: none;">
                                {{ $meta->metatag_code }}
                            </div>
                        @else
                            {{ $meta->metatag_code }}
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('metatag.edit', $meta->id) }}" class="edit-btn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                                <span>Edit</span>
                            </a>

                            <form action="{{ route('metatag.destroy', $meta->id) }}" method="POST" class="delete-form"
                                style="display: inline;">
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
                @endforeach
            </tbody>
        </table>

        

        <div class="d-flex justify-content-center align-items-center mt-4 flex-wrap gap-3">
    <nav class="modern-pagination">
        {!! $metatags->links('pagination::bootstrap-5') !!}
    </nav>
</div>
    </div>
</div>

<!-- Modal for Read More -->
<div id="metaModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-modal" onclick="closeMetaModal()">&times;</span>
        <pre id="metaModalContent" style="white-space: pre-wrap;"></pre>
    </div>
</div>

<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the record!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it!',
            background: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }

    function showMetaModal(id) {
        const content = document.getElementById('meta-code-' + id).innerText;
        document.getElementById('metaModalContent').innerText = content;
        document.getElementById('metaModal').style.display = 'block';
    }

    function closeMetaModal() {
        document.getElementById('metaModal').style.display = 'none';
    }
</script>
@endsection
