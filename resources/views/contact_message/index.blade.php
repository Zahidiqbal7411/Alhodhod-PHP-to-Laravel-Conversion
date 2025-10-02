@extends('layouts.app')

@section('Main-content')

@push('styles')
<style>
    .read-more-link {
        color: #007bff;
        font-size: 14px;
        text-decoration: none;
        margin-left: 5px;
    }

    .read-more-link:hover {
        text-decoration: underline;
    }
</style>
@endpush

<div class="container mt-4">
    <h2>Contact Messages</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th style="width: 60px;">ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            @php
            $maxLength = 100;
            $isLong = strlen($message->text) > $maxLength;
            $shortText = $isLong ? substr($message->text, 0, $maxLength) . '...' : $message->text;
            @endphp
            <tr>
                <td>{{ $message->id }}</td>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->title }}</td>
                <td>
                    {{ $shortText }}
                    @if($isLong)
                    <a href="#" class="read-more-link" data-bs-toggle="modal"
                        data-bs-target="#modal{{ $message->id }}">Read more</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center align-items-center mt-4 flex-wrap gap-3">
        <nav class="modern-pagination">
            {!! $messages->links('pagination::bootstrap-5') !!}
        </nav>
    </div>
</div>

<!-- ✅ Modals outside the table -->
@foreach($messages as $message)
@if(strlen($message->text) > 100)
<div class="modal fade" id="modal{{ $message->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $message->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $message->id }}">Full Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! nl2br(e($message->text)) !!}
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

@endsection