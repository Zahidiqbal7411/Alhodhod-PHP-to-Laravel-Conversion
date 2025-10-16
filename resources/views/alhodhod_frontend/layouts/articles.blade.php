<div class="container position-relative" data-lang="{{ $lang }}">
    <div class="position-relative">

        <!-- ✅ Outer wrapper to prevent overflow leak -->
        <div class="overflow-hidden">
            <!-- ✅ Scrollable Card Row with Left and Right Padding -->
            <div id="articleRow"
                 class="d-flex flex-nowrap overflow-auto ps-5 pe-4 pb-3 g-0"
                 style="scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none; overflow-y: hidden; scroll-snap-type: x mandatory;
                    scroll-padding-left: 1rem;">
                 
                

                @foreach($articles as $article)
                    @php
                        $cleanContent = strip_tags(htmlspecialchars_decode($article->content));
                        $shortDescription = mb_strlen($cleanContent) > 300
                            ? mb_substr($cleanContent, 0, 300) . ' <strong>read more ...</strong>'
                            : $cleanContent;
                    @endphp

                    <div class="article-card">
                        <a href="{{ url('articles/' . urlencode($article->article_slug)) }}" class="text-decoration-none text-dark">
                            <div class="card custom-card h-100">
                                <img src="{{ asset($article->article_image) }}"
                                     class="card-img-top"
                                     alt="Article Image"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $article->article_title }}</h5>
                                    <p class="card-text">{!! $shortDescription !!}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ✅ Left Scroll Button with margin over padding -->
        <button class="scroll-btn left position-absolute top-50 start-0 translate-middle-y"
                onclick="scrollArticles('left')"
                style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
            {{ $leftArrow }}
        </button>

        <!-- ✅ Right Scroll Button -->
        <button class="scroll-btn right position-absolute top-50 end-0 translate-middle-y"
                onclick="scrollArticles('right')"
                style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
            {{ $rightArrow }}
        </button>
    </div>
</div>






@push('scripts')

<script>
    AOS.init();
</script>

  


</script>


@endpush
