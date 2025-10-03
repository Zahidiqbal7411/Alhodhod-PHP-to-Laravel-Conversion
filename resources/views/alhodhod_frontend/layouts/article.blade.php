<section>
  <div class="container position-relative" data-lang="{{ $lang }}">
    <!-- Left Navigation Button -->
    <button class="scroll-btn left" onclick="scrollArticles('left')" style="display: {{ $articles->count() ? 'block' : 'none' }};">
      {{ $leftArrow }}
    </button>

    <div class="row flex-nowrap overflow-hidden" id="articleRow">
      @if($articles->count())
        @foreach($articles as $article)
          @php
            $cleanContent = strip_tags(htmlspecialchars_decode($article->content));
            $shortDescription = mb_strlen($cleanContent) > 300
                ? mb_substr($cleanContent, 0, 300) . ' <strong>read more ...</strong>'
                : $cleanContent;
          @endphp

          <div class="col-md-4 col-sm-12 col-xs-12 col-lg-4">
            <a href="{{ url('articles/' . urlencode($article->article_slug)) }}"
               class="text-decoration-none text-dark">
              <div class="card custom-card">
                <img src="{{ asset($article->article_image) }}"
                     class="card-img-top" alt="Article Image" style="height:200px;">
                <div class="card-body">
                  <h5 class="card-title">{{ $article->article_title }}</h5>
                  <p class="card-text">{!! $shortDescription !!}</p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      @else
        <p class="text-center">No articles found.</p>
      @endif
    </div>

    <!-- Right Navigation Button -->
    <button class="scroll-btn right" onclick="scrollArticles('right')" style="display: {{ $articles->count() ? 'block' : 'none' }};">
      {{ $rightArrow }}
    </button>
  </div>
</section>
