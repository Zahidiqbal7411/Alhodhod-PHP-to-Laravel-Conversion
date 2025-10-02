@php
    $ads = get_ads(1); // Change '1' to your actual ad_type if needed
@endphp

@if($ads->isNotEmpty())
    <div class="ad-headerr">
        <p class="text-center">Sponsored Ads</p>
    </div>

    <div class="slider-container">
        <div class="slider" style="direction: ltr !important;">
            @foreach($ads as $ad)
                <div class="slide">
                    <a href="javascript:;" onclick="ad_click('{{ $ad->id }}','{{ $ad->ad_link }}');">
                        <img src="{{ $ad->ad_url }}" alt="Ad {{ $loop->iteration }}" style="width:100% !important;">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="dots">
            @foreach($ads as $index => $ad)
                <span class="dot" data-index="{{ $index }}"></span>
            @endforeach
        </div>
    </div>
@endif
