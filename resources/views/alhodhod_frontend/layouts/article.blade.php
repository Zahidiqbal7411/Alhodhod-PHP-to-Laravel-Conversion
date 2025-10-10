{{-- <section>
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
</section> --}}
{{-- <div class="container position-relative" data-lang="{{ $lang }}">
    <!-- Scroll Left Button -->
    <button class="scroll-btn left position-absolute top-50 start-0 translate-middle-y z-3" onclick="scrollArticles('left')" style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
        {{ $leftArrow }}
    </button>

    <!-- Scrollable Row -->
    <div id="articleRow" class="row flex-nowrap overflow-auto px-2" style="scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none;">
        <style>
            #articleRow::-webkit-scrollbar {
                display: none;
            }
            .article-card {
                min-width: 100%;
            }

            @media (min-width: 576px) {
                .article-card {
                    min-width: 80%;
                }
            }

            @media (min-width: 768px) {
                .article-card {
                    min-width: 50%;
                }
            }

            @media (min-width: 992px) {
                .article-card {
                    min-width: calc(100% / 3);
                }
            }

            .scroll-padding-end {
                padding-right: 3rem; /* Padding to prevent last card overlap */
            }
        </style>

        @foreach($articles as $article)
            @php
                $cleanContent = strip_tags(htmlspecialchars_decode($article->content));
                $shortDescription = mb_strlen($cleanContent) > 300
                    ? mb_substr($cleanContent, 0, 300) . ' <strong>read more ...</strong>'
                    : $cleanContent;
            @endphp

            <div class="col-12 col-sm-10 col-md-6 col-lg-4 article-card">
                <a href="{{ url('articles/' . urlencode($article->article_slug)) }}" class="text-decoration-none text-dark">
                    <div class="card custom-card h-100">
                        <img src="{{ asset('uploadimage/article_image/quran.jpg') }}" class="card-img-top" alt="Article Image" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->article_title }}</h5>
                            <p class="card-text">{!! $shortDescription !!}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

        <!-- Spacer at the end to prevent overlap with right button -->
        <div class="scroll-padding-end"></div>
    </div>

    <!-- Scroll Right Button -->
    <button class="scroll-btn right position-absolute top-50 end-0 translate-middle-y z-3" onclick="scrollArticles('right')" style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
        {{ $rightArrow }}
    </button>
</div> --}}
{{-- <div class="container position-relative" data-lang="{{ $lang }}">
    <!-- Scroll Left Button -->
    <button class="scroll-btn left position-absolute top-50 start-0 translate-middle-y z-3" onclick="scrollArticles('left')" style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
        {{ $leftArrow }}
    </button>

    <!-- Scrollable Card Row -->
    <div id="articleRow" class="d-flex flex-nowrap overflow-auto px-2" style="scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none;">
        <style>
            #articleRow::-webkit-scrollbar {
                display: none;
            }

            .article-card {
                flex: 0 0 calc(100% / 3 - 1rem); /* Show 3 cards per screen */
                margin-right: 1rem;
            }

            @media (max-width: 992px) {
                .article-card {
                    flex: 0 0 50%;
                }
            }

            @media (max-width: 768px) {
                .article-card {
                    flex: 0 0 80%;
                }
            }

            @media (max-width: 576px) {
                .article-card {
                    flex: 0 0 100%;
                }
            }

            /* Right spacer to prevent overlap with scroll button */
            .scroll-end-spacer {
                flex: 0 0 40px; /* same or more than button width */
                pointer-events: none;
            }
        </style>

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
                        <img src="{{ asset('uploadimage/article_image/quran.jpg') }}" class="card-img-top" alt="Article Image" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->article_title }}</h5>
                            <p class="card-text">{!! $shortDescription !!}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

        <!-- Right Spacer to fix clipping -->
        <div class="scroll-end-spacer"></div>
    </div>

    <!-- Scroll Right Button -->
    <button class="scroll-btn right position-absolute top-50 end-0 translate-middle-y z-3" onclick="scrollArticles('right')" style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
        {{ $rightArrow }}
    </button>
</div> --}}
{{-- <div class="container position-relative" data-lang="{{ $lang }}">
    <!-- Scroll Left Button -->
    <button class="scroll-btn left position-absolute top-50 start-0 translate-middle-y z-3 ms-2" 
            onclick="scrollArticles('left')" 
            style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
        {{ $leftArrow }}
    </button>

    <!-- Scrollable Card Row -->
    <div id="articleRow" 
         class="d-flex flex-nowrap overflow-auto px-2" 
         style="scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none;">
        <style>
            #articleRow::-webkit-scrollbar {
                display: none;
            }

            .article-card {
                flex: 0 0 calc(100% / 3 - 1rem); /* 3 cards per screen */
                margin-right: 1rem;
            }

            @media (max-width: 992px) {
                .article-card {
                    flex: 0 0 50%;
                }
            }

            @media (max-width: 768px) {
                .article-card {
                    flex: 0 0 80%;
                }
            }

            @media (max-width: 576px) {
                .article-card {
                    flex: 0 0 100%;
                }
            }

            .scroll-end-spacer {
                flex: 0 0 100px; /* Space after last card */
                pointer-events: none;
            }
        </style>

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
                        <img src="{{ asset('uploadimage/article_image/quran.jpg') }}" class="card-img-top" alt="Article Image" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->article_title }}</h5>
                            <p class="card-text">{!! $shortDescription !!}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

        <!-- Spacer after the last card to prevent overlap -->
        <div class="scroll-end-spacer"></div>
    </div>

    <!-- Scroll Right Button with margin -->
    <button class="scroll-btn right position-absolute top-50 end-0 translate-middle-y z-3 me-2" 
            onclick="scrollArticles('right')" 
            style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
        {{ $rightArrow }}
    </button>
</div> --}}

<div class="container position-relative" data-lang="{{ $lang }}">
    <div class="position-relative">

        <!-- ✅ Outer wrapper to prevent overflow leak -->
        <div class="overflow-hidden">
            <!-- ✅ Scrollable Card Row with Left and Right Padding -->
            <div id="articleRow"
                 class="d-flex flex-nowrap overflow-auto ps-5 pe-4 pb-3" {{-- 👈 Add ps-5 --}}
                 style="scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none; overflow-y: hidden; scroll-snap-type: x mandatory;
                    scroll-padding-left: 1rem;">
                 
                <style>
                    #articleRow::-webkit-scrollbar {
                        display: none;
                    }

                    .article-card {
                        flex: 0 0 32%;
                        max-width: 32%;
                        margin-right: 2%;
                    }

                    @media (max-width: 992px) {
                        .article-card {
                            flex: 0 0 48%;
                            max-width: 48%;
                            margin-right: 4%;
                        }
                    }

                    @media (max-width: 768px) {
                        .article-card {
                            flex: 0 0 80%;
                            max-width: 80%;
                            margin-right: 5%;
                        }
                    }

                    @media (max-width: 576px) {
                        .article-card {
                            flex: 0 0 100%;
                            max-width: 100%;
                            margin-right: 0;
                        }
                    }
                </style>

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
                                <img src="{{ asset('uploadimage/article_image/quran.jpg') }}"
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
        <button class="scroll-btn left position-absolute top-50 start-0 translate-middle-y z-3 ms-2"
                onclick="scrollArticles('left')"
                style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
            {{ $leftArrow }}
        </button>

        <!-- ✅ Right Scroll Button -->
        <button class="scroll-btn right position-absolute top-50 end-0 translate-middle-y z-3 me-2"
                onclick="scrollArticles('right')"
                style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
            {{ $rightArrow }}
        </button>
    </div>
</div>



    <!-- Scroll Right Button -->
    <button class="scroll-btn right position-absolute top-50 end-0 translate-middle-y z-3" onclick="scrollArticles('right')" style="display: {{ $articles->count() > 3 ? 'block' : 'none' }};">
        {{ $rightArrow }}
    </button>
</div>


    <!-- Right Button -->
    <button class="scroll-btn right position-absolute top-50 end-0 translate-middle-y z-3" onclick="scrollArticles('right')" style="display: {{ $articles->count() ? 'block' : 'none' }};">
        {{ $rightArrow }}
    </button>
</div>


  <!-- Right Button -->
  <button class="scroll-btn right" onclick="scrollArticles('right')" style="display: {{ $articles->count() ? 'block' : 'none' }};">
    {{ $rightArrow }}
  </button>
</div>
