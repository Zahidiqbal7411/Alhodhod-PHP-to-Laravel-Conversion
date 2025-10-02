   <!-- Top Header -->
      <header class="main-header">
        <div class="header-left">
          <h1 class="page-title">Dashboard</h1>
          <div class="breadcrumb">
            <i class="fa-solid fa-kaaba"></i>
            <span>/ Dashboard</span>
          </div>
        </div>
        <div class="header-right">
          <div class="header-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" placeholder="Search dreams..." />
          </div>
          <div class="profile" id="profileMenu">
            <div class="profile-info">
              <span class="welcome">Welcome back,</span>
              <span class="name">Admin</span>
            </div>
            <img src="https://i.pravatar.cc/40?img=12" alt="Profile Avatar" class="avatar" />
            <i class="fa-solid fa-chevron-down"></i>
            <div class="dropdown">
              <div class="dropdown-menu">
                <a href="#" class="menu-item">
                  <i class="fas fa-user"></i>
                  <span>My Profile</span>
                </a>
                <a href="#" class="menu-item">
                  <i class="fas fa-key"></i>
                  <span>Reset Password</span>
                </a>
                <a href="#" class="menu-item logout">
                  <i class="fas fa-sign-out-alt"></i>
                  <span>Logout</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- Hero Section -->
      <section class="hero">
        <div class="islamic-pattern"></div>
        <div class="star-field" id="starField"></div>
        <div class="hero-content">
          <div class="hero-icon">
            <i class="fas fa-moon"></i>
          </div>
          <h2>ISLAMIC DREAMS INTERPRETATION</h2>
          <p>BECAUSE YOUR DREAMS ARE MEANINGFUL!</p>
          <div class="hero-buttons">
            <button class="cta-button primary">
              <i class="fas fa-book-open"></i>
              Explore Dreams
            </button>
            <button class="cta-button secondary">
              <i class="fas fa-video"></i>
              Watch Guide
            </button>
          </div>
        </div>
      </section>

<!-- Background elements -->
<div class="mesh-gradient"></div>
<div class="decoration-circles">
    <div class="decoration-circle"></div>
    <div class="decoration-circle"></div>
    <div class="decoration-circle"></div>
</div>

<!-- Main content area -->
<main class="main">
    <!-- Content wrapper -->
    <div class="main-content">
        {{ $slot }}
    </div>
</main>