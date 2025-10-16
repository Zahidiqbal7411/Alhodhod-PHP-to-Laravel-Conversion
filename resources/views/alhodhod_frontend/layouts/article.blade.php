@php
    $articles_path = asset('manage_ad/public/');
@endphp

<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<style>
body {
    background-color: #f8f9fa;
    font-family: "Roboto", serif;
    margin: 0;
    padding: 0;
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
    background: #fff;
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
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
}

.related-article-row::-webkit-scrollbar {
    display: none;
}

.related-article-row {
    scrollbar-width: none;
}

.related-article-card {
    flex: 0 0 calc((100% - 2rem)/3);
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: transform 0.2s;
    display: flex;
    flex-direction: column;
    height: 320px;
}

.related-article-card:hover {
    transform: translateY(-5px);
}

.related-article-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.related-article-card h5 {
    margin: 0.5rem 0;
    text-align: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.related-article-card p {
    font-size: 14px;
    text-align: justify;
    padding: 0 0.5rem 0.5rem 0.5rem;
    flex-grow: 1;
    overflow: hidden;
}

.scroll-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 123, 255, 0.85);
    color: white;
    border: none;
    font-size: 2rem;
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    cursor: pointer;
    z-index: 20;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    transition: background-color 0.3s, transform 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.scroll-btn:hover {
    background-color: rgba(0, 123, 255, 1);
    transform: translateY(-50%) scale(1.1);
}

.scroll-btn.left {
    left: 5px;
}

.scroll-btn.right {
    right: 5px;
}

@media (max-width: 768px) {
    .scroll-btn {
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
    }
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

.back-button:hover {
    background: #0056b3;
}

@media (max-width: 1024px) {
    .related-article-card {
        flex: 0 0 calc((100% - 1rem)/2);
        height: 300px;
    }
}

@media (max-width: 768px) {
    .related-article-card {
        flex: 0 0 90%;
        margin: 0 auto;
        height: auto;
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
            <img src="{{ asset($article->article_image) }}" alt="Article Image">
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
                            <img src="{{ asset($related->article_image) }}" alt="Article Image">
                            <div>
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
