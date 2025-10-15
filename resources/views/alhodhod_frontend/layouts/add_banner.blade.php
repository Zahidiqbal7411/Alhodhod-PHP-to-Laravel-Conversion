@push('styles')
@endpush
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
                    <a href="javascript:;"  onclick="ad_click('{{ $ad->id }}','{{ $ad->ad_link }}');">
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

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.slider');
    const dots = document.querySelectorAll('.dot');
    const totalSlides = dots.length;
    let currentIndex = 0;
    let slideInterval;

    function goToSlide(index) {
      if (index < 0) index = totalSlides - 1;
      if (index >= totalSlides) index = 0;
      slider.style.transform = `translateX(-${index * 100}%)`;
      dots.forEach(dot => dot.classList.remove('active'));
      dots[index].classList.add('active');
      currentIndex = index;
    }

    function nextSlide() {
      goToSlide(currentIndex + 1);
    }

    // Initialize
    if (totalSlides > 0) {
      goToSlide(0);

      slideInterval = setInterval(nextSlide, 4000);

      dots.forEach((dot, idx) => {
        dot.addEventListener('click', () => {
          goToSlide(idx);
          clearInterval(slideInterval); // Reset interval so it doesn't jump immediately
          slideInterval = setInterval(nextSlide, 4000);
        });
      });
    }
  });
</script>

@endpush