document.addEventListener("DOMContentLoaded", function () {
  // 1. Handle hover dropdowns (desktop)
  document.querySelectorAll(".navbar .dropdown").forEach(dropdown => {
    const menu = dropdown.querySelector(".dropdown-menu");
  
    if (!menu) return;

    dropdown.addEventListener("mouseenter", () => {
      if (window.innerWidth > 768) {
        menu.classList.add("show");
      }
    });

    dropdown.addEventListener("mouseleave", () => {
      if (window.innerWidth > 768) {
        menu.classList.remove("show");
      }
    });
  });

  // 2. Language dropdown (click-based)
  const langDropdown = document.querySelector("#dropdownMenuButton1");
  if (langDropdown) {
    const langMenu = langDropdown.querySelector(".dropdown-menu");
    const langButton = langDropdown.querySelector("button");

    langButton.addEventListener("click", function (e) {
      e.stopPropagation();
      langMenu.classList.toggle("show");
    });
  }

  // 3. Hamburger menu
  const hamburger = document.querySelector(".hamburger");
  const navbar = document.querySelector(".navbar");

  if (hamburger && navbar) {
    hamburger.addEventListener("click", function (e) {
      e.stopPropagation();
      navbar.classList.toggle("show");
    });
  }

  // 4. Click outside to close dropdowns
  document.addEventListener("click", function () {
    // Close all dropdowns
    document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
      menu.classList.remove("show");
    });

    // Close navbar on small screens
    if (window.innerWidth <= 768 && navbar.classList.contains("show")) {
      navbar.classList.remove("show");
    }
  });

  // 5. Window resize behavior
  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) {
      navbar.classList.remove("show");
      document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
        menu.classList.remove("show");
      });
    }
  });
});


document.addEventListener('DOMContentLoaded', function () {
  const menuLinks = document.querySelectorAll('.menu-link');

  menuLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();

      const menuId = this.dataset.id;

      // Elements to update
      const dreamContainer = document.querySelector('.dream-container');
      console.log('Clicked menu ID:', dreamContainer);
      const articleRow = document.querySelector('#articleRow');

      if (!menuId || !articleRow) return;

      // Hide dream container
      if (dreamContainer) {
        dreamContainer.style.display = 'none';
      }

      // Clear current articles
      articleRow.innerHTML = '<p>Loading...</p>';

      // Fetch new articles via AJAX
      fetch(`/menu/${menuId}/articles`)
        .then(res => res.json())
        .then(data => {
          if (data.html) {
            articleRow.innerHTML = data.html;
          } else {
            articleRow.innerHTML = '<p>No articles found.</p>';
          }
        })
        .catch(err => {
          console.error('Error fetching articles:', err);
          articleRow.innerHTML = '<p>Error loading articles.</p>';
        });
    });
  });
});


function scrollArticles(direction) {
    const row = document.getElementById('articleRow');
    const card = row.querySelector('.article-card');

    if (!card) return;

    // Get full width including margin (optional)
    const cardStyle = getComputedStyle(card);
    const marginRight = parseInt(cardStyle.marginRight) || 0;
    const scrollAmount = card.offsetWidth + marginRight;

    row.scrollBy({
        left: direction === 'left' ? -scrollAmount : scrollAmount,
        behavior: 'smooth'
    });
}



