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
