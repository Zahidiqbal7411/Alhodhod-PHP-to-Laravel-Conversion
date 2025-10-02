@extends('layouts.app')

@section('Main-content')

@push('styles')
  <link rel="stylesheet" href="{{ asset('styling/contact-info.css') }}">
@endpush

<div class="contact-wrapper">
    <div class="pages-header">
        <h1 class="pages-title">Contact Information</h1>
    </div>

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="contact-table">
                <thead>
                    <tr>
                        <th>EN Title</th>
                        <th>EN Value</th>
                        <th>FR Title</th>
                        <th>FR Value</th>
                        <th>AR Title</th>
                        <th>AR Value</th>
                        <th>Icon</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $defaults = [
                            [
                                'en_title' => 'Email',
                                'en_value' => 'info@example.com',
                                'fr_title' => 'Email',
                                'fr_value' => 'info@exemple.fr',
                                'ar_title' => 'البريد الإلكتروني',
                                'ar_value' => 'info@مثال.كوم',
                                'icon' => 'fa-envelope',
                            ],
                            [
                                'en_title' => 'Phone',
                                'en_value' => '+123 456 7890',
                                'fr_title' => 'Téléphone',
                                'fr_value' => '+123 456 7890',
                                'ar_title' => 'الهاتف',
                                'ar_value' => '+١٢٣ ٤٥٦ ٧٨٩٠',
                                'icon' => 'fa-phone',
                            ],
                            [
                                'en_title' => 'Address',
                                'en_value' => '123 Main St, City',
                                'fr_title' => 'Adresse',
                                'fr_value' => '123 Rue Principale, Ville',
                                'ar_title' => 'العنوان',
                                'ar_value' => '١٢٣ شارع الرئيسي، المدينة',
                                'icon' => 'fa-map-marker',
                            ],
                            [
                                'en_title' => 'Website',
                                'en_value' => 'www.example.com',
                                'fr_title' => 'Site Web',
                                'fr_value' => 'www.exemple.fr',
                                'ar_title' => 'موقع إلكتروني',
                                'ar_value' => 'www.مثال.كوم',
                                'icon' => 'fa-globe',
                            ],
                            [
                                'en_title' => 'Fax',
                                'en_value' => '+123 456 0000',
                                'fr_title' => 'Fax',
                                'fr_value' => '+123 456 0000',
                                'ar_title' => 'فاكس',
                                'ar_value' => '+١٢٣ ٤٥٦ ٠٠٠٠',
                                'icon' => 'fa-fax',
                            ],
                        ];

                        $contacts = \App\Models\Contact::orderBy('id')->take(5)->get();
                        $formData = $contacts->count() > 0 ? $contacts : collect($defaults);
                    @endphp

                    @foreach($formData as $index => $contact)
                    <tr>
                        <td><input type="text" name="contacts[{{ $index }}][en_title]" value="{{ $contact['en_title'] }}" class="input-field"></td>
                        <td><input type="text" name="contacts[{{ $index }}][en_value]" value="{{ $contact['en_value'] }}" class="input-field"></td>
                        <td><input type="text" name="contacts[{{ $index }}][fr_title]" value="{{ $contact['fr_title'] }}" class="input-field"></td>
                        <td><input type="text" name="contacts[{{ $index }}][fr_value]" value="{{ $contact['fr_value'] }}" class="input-field"></td>
                        <td><input type="text" name="contacts[{{ $index }}][ar_title]" value="{{ $contact['ar_title'] }}" class="input-field" dir="rtl"></td>
                        <td><input type="text" name="contacts[{{ $index }}][ar_value]" value="{{ $contact['ar_value'] }}" class="input-field" dir="rtl"></td>
                        <td class="icon-select-wrapper">
                            <i class="fas {{ $contact['icon'] ?? 'fa-envelope' }} icon-preview" id="icon-preview-{{ $index }}"></i>
                            <select name="contacts[{{ $index }}][icon]" class="icon-select" data-index="{{ $index }}">
                                @foreach([
                                    'fa-envelope', 'fa-phone', 'fa-map-marker', 'fa-globe', 'fa-fax',
                                    'fa-at', 'fa-inbox', 'fa-paper-plane', 'fa-mail-bulk',
                                    'fa-envelope-open', 'fa-address-card'
                                ] as $icon)
                                    <option value="{{ $icon }}" {{ ($contact['icon'] ?? '') === $icon ? 'selected' : '' }}>
                                        {{ ucwords(str_replace(['fa-', '-'], ['', ' '], $icon)) }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="form-footer">
            <button type="submit" class="submit-button">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.icon-select').forEach(select => {
            select.addEventListener('change', function () {
                const iconClass = this.value;
                const index = this.dataset.index;
                const iconElem = document.getElementById('icon-preview-' + index);
                iconElem.className = 'fas ' + iconClass + ' icon-preview';
            });
        });
    });
</script>

@endsection
