
@php
    $articles_path = asset('manage_ad/public/');
@endphp

<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f8f9fa;
        font-family: "Roboto", serif;
    }

    h3 {
        display: inline-block;
        position: relative;
        text-align: center;
        padding-bottom: 5px;
    }

    h3::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0%;
        height: 3px;
        background-color: black;
        transition: width 1.4s ease-in-out, left 0.4s ease-in-out;
    }

    h3:hover::after {
        width: 60%;
        left: 20%;
    }

    .article-wrapper {
        padding: 1.5rem;
        background: linear-gradient(135deg, #f7ece6, #def5f2, #edeff9);
    }

    .article-heading {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .article-box {
        max-width: 1000px;
        margin: 0 auto;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .article-box img {
        width: 100%;
        height: auto;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .article-content {
        padding: 1rem;
    }

    .article-content iframe {
        width: 100% !important;
        height: auto;
        display: block;
    }

    .related-articles {
        position: relative;
        margin-top: 2rem;
    }

    .related-article-row {
        display: flex;
        overflow-x: auto;
        gap: 1rem;
        padding: 1rem 2rem;
    }

    .related-article-card {
        flex: 0 0 30%;
        min-width: 280px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .related-article-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .related-article-card h5 {
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .related-article-card p {
        font-size: 14px;
    }

    .scroll-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: blue;
        color: white;
        border: none;
        font-size: 2rem;
        padding: 8px 12px;
        cursor: pointer;
        z-index: 108;
        border-radius: 50%;
    }

    .scroll-btn.left {
        left: -20px;
    }

    .scroll-btn.right {
        right: -20px;
    }

    .back-button-wrapper {
        text-align: center;
        margin-top: 2rem;
    }

    .back-button {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .scroll-btn {
            font-size: 1.5rem;
            padding: 6px 10px;
        }

        .related-article-card {
            flex: 0 0 90%;
            margin: 0 auto;
        }

        .related-article-row {
            scroll-snap-type: x mandatory;
        }

        .related-article-card {
            scroll-snap-align: center;
        }
    }
</style>

<div class="article-wrapper">
    <div class="article-heading">
        <h3 style="font-weight: 700; font-size: 54px;">{{ $article->article_title }}</h3>
    </div>

    <div class="article-container" style="margin-bottom: 1.5rem;">
        <div class="article-box" data-aos="fade-down-right">
            <img src="{{ asset('uploadimage/article_image/quran.jpg') }}" alt="Article Image">
            <div class="article-content">
                <p style="text-align: center;">{!! $article->content !!}</p>
            </div>
        </div>
    </div>

    <ins class="adsbygoogle"
        style="display:block"
        data-ad-client="ca-pub-4511775489420895"
        data-ad-slot="7497405544"
        data-ad-format="auto"
        data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    @if (isset($related_articles) && $related_articles->isNotEmpty())
        <div class="related-articles">
            <button class="scroll-btn left" onclick="scrollArticles('left')">❮</button>

            <div class="related-article-row" id="articleRow">
                @foreach ($related_articles as $related)
                    @php
                        $cleanContent = strip_tags($related->content);
                        $shortDescription = mb_strlen($cleanContent) > 300
                            ? mb_substr($cleanContent, 0, 300) . ' <strong>read more ...</strong>'
                            : $cleanContent;
                    @endphp
                    <div class="related-article-card">
                        <a href="{{ url('/articles/' . urlencode($related->article_slug)) }}" style="text-decoration: none; color: inherit;">
                            <img src="{{ $articles_path . '/' . $related->article_image }}" alt="Article Image">
                            <div style="padding: 1rem;">
                                <h5>{{ $related->article_title }}</h5>
                                <p>{!! $shortDescription !!}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <button class="scroll-btn right" onclick="scrollArticles('right')">❯</button>
        </div>
    @endif

    <div class="back-button-wrapper">
        <a href="{{ url('/') }}" class="back-button">Back to Home</a>
    </div>
</div>

<script>
    AOS.init();

    function scrollArticles(direction) {
        const container = document.getElementById('articleRow');
        const scrollAmount = 700;
        container.scrollBy({
            left: direction === 'left' ? -scrollAmount : scrollAmount,
            behavior: 'smooth'
        });
    }
</script>
