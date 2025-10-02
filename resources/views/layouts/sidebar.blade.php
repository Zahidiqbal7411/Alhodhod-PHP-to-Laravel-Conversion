<aside class="sidebar">
    <div class="brand">
        <div class="brand-logo">
            <i class="fa-solid fa-mosque floating-icon"></i>
            <i class="fa-solid fa-dove floating-icon brand-icon"></i>
        </div>
        <span>Alhodhod</span>
    </div>
    <ul class="nav">
        <li>
            <a href="{{route('home')}}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-kaaba"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{route('ads.index')}}" class="nav-link">
                <i class="fa-solid fa-image"></i> <!-- Font Awesome Image Icon -->
                <span>Banners</span>
            </a>
        </li>
        <li>
            <a href="{{route('pages.index')}}" class="nav-link">
                <i class="fa-solid fa-file"></i>
                <span>Pages</span>
            </a>
        </li>
        <li>
            <a href="{{route('menus.index')}}" class="nav-link">
                <i class="fa-solid fa-bars-staggered"></i>
                <span>Menus</span>
            </a>
        </li>
        <li>
            <a href="{{route('articles.index')}}" class="nav-link">
                <i class="fa-solid fa-star-and-crescent"></i>
                <span>Articles</span>
            </a>
        </li>
        <li>
            <a href="{{route('articleimage.index')}}" class="nav-link">
                <i class="fa-solid fa-images"></i>
                <span>Article Images</span>
            </a>
        </li>
        <li>
            <a href="{{route('contact.index')}}" class="nav-link">
                <i class="fa-solid fa-hands-praying"></i>
                <span>Contact Us</span>
            </a>
        </li>
        <li>
            <a href="{{route('contact_message.index')}}" class="nav-link">
                <i class="fa-solid fa-envelope-open-text"></i>
                <span>Contact Messages</span>
            </a>
        </li>
        <li>
            <a href="{{route('metatag.index')}}" class="nav-link">
                <i class="fa-solid fa-tags"></i>
                <span>Meta Tags (only for SEO)</span>
            </a>
        </li>
    </ul>
</aside>