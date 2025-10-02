@extends('layouts.app')

@section('Main-content')
<link rel="stylesheet" href="{{ asset('styling/pages.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<div class="pages-container">
    <div class="pages-header">
        <h1 class="pages-title">Contact Form</h1>
    </div>

    <form method="POST" action="#">
        @csrf

        <div class="pages-table-container">
            <div class="table-responsive">
                <table class="pages-table" style="min-width: 900px;">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">English</th>
                            <th colspan="2" class="text-center">French</th>
                            <th colspan="2" class="text-center">Arabic</th>
                            <th class="text-center">Icon</th>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <th>Value</th>
                            <th>Title</th>
                            <th>Value</th>
                            <th>Title</th>
                            <th>Value</th>
                            <th>Icon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 2; $i++) <tr>
                            <td><input type="text" name="contacts[{{ $i }}][en_title]" class="form-control"
                                    placeholder="English Title"></td>
                            <td><input type="text" name="contacts[{{ $i }}][en_value]" class="form-control"
                                    placeholder="English Value"></td>
                            <td><input type="text" name="contacts[{{ $i }}][fr_title]" class="form-control"
                                    placeholder="French Title"></td>
                            <td><input type="text" name="contacts[{{ $i }}][fr_value]" class="form-control"
                                    placeholder="French Value"></td>
                            <td><input type="text" name="contacts[{{ $i }}][ar_title]" class="form-control"
                                    placeholder="Arabic Title" dir="rtl"></td>
                            <td><input type="text" name="contacts[{{ $i }}][ar_value]" class="form-control"
                                    placeholder="Arabic Value" dir="rtl"></td>
                            <td>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <i class="fa fa-envelope icon-preview" style="font-size:20px;"></i>
                                    <select name="contacts[{{ $i }}][icon]" class="form-select icon-select">
                                        <option value="fa-envelope">Envelope</option>
                                        <option value="fa-map-marker">Map Marker</option>
                                        <option value="fa-globe">Globe</option>
                                        <option value="fa-fax">Fax</option>
                                        <option value="fa-at">@ Symbol</option>
                                        <option value="fa-inbox">Inbox</option>
                                        <option value="fa-paper-plane">Paper Plane</option>
                                        <option value="fa-mail-bulk">Bulk Mail</option>
                                        <option value="fa-envelope-open">Envelope Open</option>
                                        <option value="fa-address-card">Address Card</option>
                                    </select>
                                </div>
                            </td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
                
            </div>
        </div>

        <!-- Save Button -->
        <div class="form-actions" style="text-align: center; margin-top: 20px;">
            <button type="submit" class="submit-btn">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Save Changes</span>
            </button>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.icon-select').forEach(function(select) {
            select.addEventListener('change', function() {
                var icon = this.value;
                var iconElem = this.parentElement.querySelector('i');
                iconElem.className = 'fa ' + icon + ' icon-preview';
            });
        });
</script>
@endsection