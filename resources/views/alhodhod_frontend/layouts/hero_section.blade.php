<section class="hero_section">
    <div class="hero_container">
        <!-- navbar -->
        <nav class="navbar">

            <ul class="nav-list navbar-nav d-flex flex-row gap-3">
                @foreach ($pages as $page)
                    @php
                        $hasSubMenus = $page->menus->isNotEmpty();
                    @endphp

                    <li class="nav-item dropdown">
                        <a class="nav-link {{ $hasSubMenus ? 'dropdown-toggle' : '' }}"
                            href="{{ $page->page_link === '#' ? 'javascript:;' : url('pages/' . $page->page_link) }}"
                            {{ $hasSubMenus ? 'data-bs-toggle=dropdown role=button aria-expanded=false' : '' }}>
                            {{ $page->localized_name }}
                        </a>

                        @if ($hasSubMenus)
                            <ul class="dropdown-menu">
                                @foreach ($page->menus as $menu)
                                    <li>
                                        
                                        <a class="dropdown-item" href="{{ route('menu.articles', $menu->id) }}"
                                            data-url="{{ route('menu.articles', $menu->id) }}">
                                            {{ $menu->localized_title }}
                                        </a>


                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>


            <div class="hamburger" id="hamburger-icon">
                &#9776;
            </div>
        </nav>

        <div class="logo">
            <img src="{{ asset('asset/logo.png') }}" alt="Logo" />
            <p>Alhodhod.com</p>
            <p>{{ get_language_wordings()[0] ?? '' }}</p>
        </div>

        <div class="mobileLogo">
            <img src="{{ asset('asset/logo.png') }}" alt="Mobile Logo" />
            <p>Alhodhod</p>
        </div>

        @php
            $lang_code = get_active_language(); // 'en', 'fr', 'ar'
            $lang_map = config('global.available_languages'); // ['en' => 'english', ...]
            $activelanguage = $lang_map[$lang_code] ?? 'english';

            $english_active = $french_active = $arabic_active = '';
            ${$activelanguage . '_active'} = 'active';

            $show_active = ['english' => 'us', 'french' => 'fr', 'arabic' => 'sa'];
            $flag = $show_active[$activelanguage] ?? 'us';

            $language_wordings = config('global.language_wordings');
        @endphp


        <div id="dropdownMenuButton1" class="dropdown">
            <button class="dropdown-toggle" type="button" id="humber-Btn">
                <span class="flag-icon flag-icon-{{ $flag }} me-1"></span>
            </button>


            {{-- <ul class="dropdown-menu"  id="dropdown-menu-lang" aria-labelledby="dropdownMenuButton1"> --}}
            <ul class="dropdown-menu lang-dropdown-menu" id="dropdown-menu-lang">

                <li>
                    <a class="dropdown-item {{ $english_active }}" href="{{ url('/?lang=en') }}">
                        <span class="flag-icon flag-icon-us me-1"></span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ $french_active }}" href="{{ url('/?lang=fr') }}">
                        <span class="flag-icon flag-icon-fr me-1"></span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ $arabic_active }}" href="{{ url('/?lang=ar') }}">
                        <span class="flag-icon flag-icon-sa me-1"></span>
                    </a>
                </li>
            </ul>


        </div>


        <div class="content text-center">
            <p {!! $directionn !!}>
                <span>{{ get_language_wordings()[1] ?? '' }}</span>
                {{ get_language_wordings()[2] ?? '' }}
            </p>
            <p {!! $directionn !!}>
                {{ get_language_wordings()[3] ?? '' }}
                <span>{{ get_language_wordings()[4] ?? '' }}</span>
                {{ get_language_wordings()[5] ?? '' }}
                <span>{{ get_language_wordings()[6] ?? '' }}</span>
            </p>
        </div>

        <div class="button-container text-center">
            <a class="primary_btn" href="{{ url('/') }}">
                {{ get_language_wordings()[7] ?? '' }}
            </a>
        </div>
    </div>
</section>



@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuLinks = document.querySelectorAll('.menu-link');

            menuLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const menuId = this.dataset.id;
                    // const dreamContainer = document.querySelector('.dream-container');
                    const articleRow = document.querySelector('#articleRow');

                    if (!menuId || !articleRow) return;

                    // if (dreamContainer) {
                    //   dreamContainer.style.display = 'none';
                    // }

                    articleRow.innerHTML = '<p>Loading...</p>';

                    fetch(`/menu/${menuId}/articles`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.html) {
                                articleRow.innerHTML = data.html;
                            } else {
                                articleRow.innerHTML = '<p>No articles found.</p>';
                            }

                            // Scroll vertically to articleRow after content is loaded
                            articleRow.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        })
                        .catch(err => {
                            console.error('Error fetching articles:', err);
                            articleRow.innerHTML = '<p>Error loading articles.</p>';
                        });
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const menuLinks = document.querySelectorAll('.menu-link');

            menuLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const menuId = this.dataset.id;
                    const articleRow = document.querySelector('#articleRow');

                    if (!menuId || !articleRow) return;

                    // Show loading text
                    articleRow.innerHTML = '<p>Loading...</p>';

                    // Fetch and render articles dynamically
                    fetch(`/menu/${menuId}/articles`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.html) {
                                articleRow.innerHTML = data.html;
                            } else {
                                articleRow.innerHTML = '<p>No articles found.</p>';
                            }

                            // Smooth scroll to articles after loading
                            articleRow.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        })
                        .catch(err => {
                            console.error('Error fetching articles:', err);
                            articleRow.innerHTML = '<p>Error loading articles.</p>';
                        });
                });
            });
        });


        // 8. Scroll articles horizontally
        function scrollArticles(direction) {
            const row = document.getElementById('articleRow');
            const card = row.querySelector('.article-card');

            if (!card) return;

            // Get full width including margin
            const cardStyle = getComputedStyle(card);
            const marginRight = parseInt(cardStyle.marginRight) || 0;
            const scrollAmount = card.offsetWidth + marginRight;

            row.scrollBy({
                left: direction === 'left' ? -scrollAmount : scrollAmount,
                behavior: 'smooth'
            });
        }

        function ad_click(id, link) {
            console.log("Ad clicked:", id, link); // for debugging

            // If link is missing or invalid, do nothing
            if (!link || link === '#' || link === 'javascript:;') {
                console.warn('Invalid ad link for ad id:', id);
                return;
            }

            // Optionally send tracking info to server
            fetch(`/track-ad-click/${id}`, {
                method: 'POST'
            }).catch(() => {});

            // Open ad link in new tab
            window.open(link, '_blank');
        }


        document.addEventListener("DOMContentLoaded", function() {
            const dreamContainer = document.querySelector(".dream-container");
            const articleSection = document.querySelector("#articleRow");
            const articles = document.querySelectorAll(".article-card");

            document.addEventListener("click", function(e) {
                const dropdownItem = e.target.closest(".dropdown-item");
                if (!dropdownItem) return;

                const menuId = dropdownItem.getAttribute("data-id");
                if (!menuId) return;

                // 1️⃣ Fade out dream section
                if (dreamContainer) {
                    dreamContainer.style.transition = "opacity 0.45s ease";
                    dreamContainer.style.opacity = "0";
                    setTimeout(() => {
                        dreamContainer.style.display = "none";
                    }, 450);
                }

                // 2️⃣ Filter and show relevant articles
                setTimeout(() => {
                    articles.forEach(article => {
                        const articleMenuId = article.getAttribute("data-menu-id");
                        if (articleMenuId === menuId) {
                            article.style.display = "block";
                        } else {
                            article.style.display = "none";
                        }
                    });
                }, 400);

                // 3️⃣ Scroll to article section
                setTimeout(() => {
                    if (articleSection) {
                        articleSection.scrollIntoView({
                            behavior: "smooth",
                            block: "start",
                        });
                    }
                }, 500);
            });
        });
    </script>
@endpush
