<section class="hero_section">
    <div class="hero_container">
        <!-- navbar -->
        <nav class="navbar">
            {{-- <ul class="nav-list">
                @foreach ($pages as $page)
                    @php
                        $pageId = $page->id;
                        $pageMenus = $menusGroupedByPage[$pageId] ?? [];
                        $onclick = ($page->page_link !== "#") ? "onclick=\"ajax_load('{$page->page_link}', '')\"" : '';
                    @endphp

                    @if (!empty($pageMenus))
                        <!-- Dropdown for pages with menus -->
                        <li class="dropdown">
                            <a href="{{ $page->page_link === '#' ? 'javascript:;' : url('pages/' . $page->page_link) }}">
                                {{ $page->page_name }}
                            </a>
                            <div class="dropdown-menu hidden">
                                @foreach ($pageMenus as $menu)
                                    <a href="#" data-id="{{ $menu['id'] }}">{{ $menu['menu_title'] }}</a>
                                @endforeach
                            </div>
                        </li>
                    @else
                        <!-- Normal nav item for pages without menus -->
                        <li class="dropdown">
                            <a href="{{ $page->page_link === '#' ? 'javascript:;' : url('pages/' . $page->page_link) }}">
                                {{ $page->page_name }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul> --}}
            <ul class="nav-list navbar-nav d-flex flex-row gap-3">
    @foreach ($pages as $page)
        @php
            $pageId = $page->id;
            $pageMenus = $menusGroupedByPage[$pageId] ?? [];
            $hasSubMenus = !empty($pageMenus);
        @endphp

        <li class="nav-item dropdown">
            <a class="nav-link {{ $hasSubMenus ? 'dropdown-toggle' : '' }}" 
               href="{{ $page->page_link === '#' ? 'javascript:;' : url('pages/' . $page->page_link) }}"
               {{ $hasSubMenus ? 'data-bs-toggle=dropdown role=button aria-expanded=false' : '' }}>
                {{ $page->page_name }}
            </a>

            @if ($hasSubMenus)
                <ul class="dropdown-menu">
                    @foreach ($pageMenus as $menu)
                        <li>
                            <a class="dropdown-item" href="#" data-id="{{ $menu['id'] }}">
                                {{ $menu['menu_title'] }}
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
            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="flag-icon flag-icon-{{ $flag }} me-1"></span>
            </button>
            <ul class="dropdown-menu hidden" aria-labelledby="dropdownMenuButton1">
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


