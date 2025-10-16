document.addEventListener("DOMContentLoaded", function () {
  const dreamContainer = document.querySelector(".dream-container");
  const articleSection = document.querySelector("#articleRow");

  document.querySelectorAll(".navbar .dropdown").forEach(dropdown => {
    const menu = dropdown.querySelector(".dropdown-menu");
    if (!menu) return;

    dropdown.addEventListener("mouseenter", () => {
      if (window.innerWidth > 768) menu.classList.add("show");
    });
    dropdown.addEventListener("mouseleave", () => {
      if (window.innerWidth > 768) menu.classList.remove("show");
    });
  });

  const hamburger = document.querySelector(".hamburger");
  const navbar = document.querySelector(".navbar");
  if (hamburger && navbar) {
    hamburger.addEventListener("click", function (e) {
      e.stopPropagation();
      navbar.classList.toggle("show");
    });
  }

  document.addEventListener("click", function () {
    document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
      menu.classList.remove("show");
    });
    if (window.innerWidth <= 768 && navbar?.classList.contains("show")) {
      navbar.classList.remove("show");
    }
  });

  document.querySelectorAll(".dropdown-item").forEach(item => {
    item.addEventListener("click", function (e) {
      e.preventDefault();

      const articleUrl = this.getAttribute("data-url");
      if (!articleUrl) return;

      if (articleSection) {
        articleSection.scrollIntoView({
          behavior: "smooth",
          block: "start"
        });

        setTimeout(() => {
          if (dreamContainer) {
            dreamContainer.style.transition = "opacity 0.5s ease";
            dreamContainer.style.opacity = "0";

            setTimeout(() => {
              dreamContainer.style.display = "none";
            }, 500);
          }
        }, 300);
      }

      setTimeout(() => {
        fetch(articleUrl, {
          headers: { "X-Requested-With": "XMLHttpRequest" }
        })
          .then(response => {
            if (!response.ok) throw new Error("Network error");
            return response.text();
          })
          .then(html => {
            const tempDiv = document.createElement("div");
            tempDiv.innerHTML = html;
            const newContent =
              tempDiv.querySelector("#articleRow")?.innerHTML || html;

            articleSection.style.opacity = "0";
            articleSection.innerHTML = newContent;
            setTimeout(() => {
              articleSection.style.transition = "opacity 0.6s ease";
              articleSection.style.opacity = "1";
            }, 50);
          })
          .catch(err => {
            console.error("Error loading new articles:", err);
            articleSection.innerHTML =
              '<p class="text-danger text-center">Failed to load articles.</p>';
          });
      }, 800);
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const dropdown = document.getElementById("dropdownMenuButton1");
  const toggleBtn = document.getElementById("humber-Btn");
  const dropdownMenu = document.getElementById("dropdown-menu-lang");

  if (!dropdown || !toggleBtn || !dropdownMenu) return;

  toggleBtn.addEventListener("click", function (e) {
    e.stopPropagation();
    dropdownMenu.classList.toggle("show");
  });

  document.addEventListener("click", function (e) {
    if (!dropdown.contains(e.target)) {
      dropdownMenu.classList.remove("show");
    }
  });

  dropdownMenu.querySelectorAll(".dropdown-item").forEach(item => {
    item.addEventListener("click", function () {
      dropdownMenu.classList.remove("show");
      const href = this.getAttribute("href");
      if (href) {
        window.location.href = href;
      }
    });
  });
});
