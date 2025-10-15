// document.addEventListener("DOMContentLoaded", function () {
//   // 1. Handle hover dropdowns (desktop)
//   document.querySelectorAll(".navbar .dropdown").forEach(dropdown => {
//     const menu = dropdown.querySelector(".dropdown-menu");
  
//     if (!menu) return;

//     dropdown.addEventListener("mouseenter", () => {
//       if (window.innerWidth > 768) {
//         menu.classList.add("show");
//       }
//     });

//     dropdown.addEventListener("mouseleave", () => {
//       if (window.innerWidth > 768) {
//         menu.classList.remove("show");
//       }
//     });
//   });

//   // 2. Language dropdown (click-based)
//   const langDropdown = document.querySelector("#dropdownMenuButton1");
//   if (langDropdown) {
//     const langMenu = langDropdown.querySelector(".dropdown-menu");
//     const langButton = langDropdown.querySelector("button");

//     langButton.addEventListener("click", function (e) {
//       e.stopPropagation();
//       langMenu.classList.toggle("show");
//     });
//   }

//   // 3. Hamburger menu
//   const hamburger = document.querySelector(".hamburger");
//   const navbar = document.querySelector(".navbar");

//   if (hamburger && navbar) {
//     hamburger.addEventListener("click", function (e) {
//       e.stopPropagation();
//       navbar.classList.toggle("show");
//     });
//   }

//   // 4. Click outside to close dropdowns
//   document.addEventListener("click", function () {
//     // Close all dropdowns
//     document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
//       menu.classList.remove("show");
//     });

//     // Close navbar on small screens
//     if (window.innerWidth <= 768 && navbar.classList.contains("show")) {
//       navbar.classList.remove("show");
//     }
//   });

//   // 5. Window resize behavior
//   window.addEventListener("resize", () => {
//     if (window.innerWidth > 768) {
//       navbar.classList.remove("show");
//       document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
//         menu.classList.remove("show");
//       });
//     }
//   });
// });

// document.addEventListener('DOMContentLoaded', function () {
//   const menuLinks = document.querySelectorAll('.menu-link');

//   menuLinks.forEach(link => {
//     link.addEventListener('click', function (e) {
//       e.preventDefault();

//       const menuId = this.dataset.id;
//       const dreamContainer = document.querySelector('.dream-container');
//       const articleRow = document.querySelector('#articleRow');

//       if (!menuId || !articleRow) return;

//       if (dreamContainer) {
//         dreamContainer.style.display = 'none';
//       }

//       articleRow.innerHTML = '<p>Loading...</p>';

//       fetch(`/menu/${menuId}/articles`)
//         .then(res => res.json())
//         .then(data => {
//           if (data.html) {
//             articleRow.innerHTML = data.html;
//           } else {
//             articleRow.innerHTML = '<p>No articles found.</p>';
//           }

//           // Scroll vertically to articleRow after content is loaded
//           articleRow.scrollIntoView({ behavior: 'smooth', block: 'start' });
//         })
//         .catch(err => {
//           console.error('Error fetching articles:', err);
//           articleRow.innerHTML = '<p>Error loading articles.</p>';
//         });
//     });
//   });
// });



// function scrollArticles(direction) {
//     const row = document.getElementById('articleRow');
//     const card = row.querySelector('.article-card');

//     if (!card) return;

//     // Get full width including margin (optional)
//     const cardStyle = getComputedStyle(card);
//     const marginRight = parseInt(cardStyle.marginRight) || 0;
//     const scrollAmount = card.offsetWidth + marginRight;

//     row.scrollBy({
//         left: direction === 'left' ? -scrollAmount : scrollAmount,
//         behavior: 'smooth'
//     });
// }



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

  // 6. Hide dream-container when navbar links are clicked
  const dreamContainer = document.querySelector(".dream-container");
  const navbarLinks = document.querySelectorAll(".navbar a");

  navbarLinks.forEach(link => {
    link.addEventListener("click", function () {
      if (dreamContainer) {
        dreamContainer.style.display = "none";
        // OR, if you want a smooth fade effect, use this instead:
        // dreamContainer.classList.add("hidden");
      }
    });
  });
});



document.addEventListener('DOMContentLoaded', function () {
  const menuLinks = document.querySelectorAll('.menu-link');

  menuLinks.forEach(link => {
    link.addEventListener('click', function (e) {
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
          articleRow.scrollIntoView({ behavior: 'smooth', block: 'start' });
        })
        .catch(err => {
          console.error('Error fetching articles:', err);
          articleRow.innerHTML = '<p>Error loading articles.</p>';
        });
    });
  });
});
document.addEventListener('DOMContentLoaded', function () {
  const menuLinks = document.querySelectorAll('.menu-link');

  menuLinks.forEach(link => {
    link.addEventListener('click', function (e) {
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
          articleRow.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
  fetch(`/track-ad-click/${id}`, { method: 'POST' }).catch(() => {});

  // Open ad link in new tab
  window.open(link, '_blank');
}



// document.addEventListener("DOMContentLoaded", function () {
//   // Delegated click handler (works for dynamic elements too)
//   document.addEventListener("click", function (e) {
//     const item = e.target.closest(".dropdown-item");
//     if (!item) return;

//     // If the dropdown item is a link or submit, stop navigation/reload
//     if (e.target.tagName === 'A' || e.target.closest('form')) {
//       e.preventDefault();
//       e.stopPropagation();
//     }

//     // Re-query in case DOM changed
//     const dreamContainer = document.querySelector(".dream-container");
//     if (!dreamContainer) {
//       console.warn("No .dream-container found when clicking .dropdown-item");
//       return;
//     }

//     // Smooth fade then remove from layout
//     dreamContainer.style.transition = "opacity 0.45s ease";
//     // Ensure initial opacity is 1 if not set
//     if (!dreamContainer.style.opacity) dreamContainer.style.opacity = "1";
//     // trigger repaint to ensure transition starts
//     void dreamContainer.offsetWidth;
//     dreamContainer.style.opacity = "0";

//     setTimeout(() => {
//       dreamContainer.style.display = "none";
//       // optional: reset opacity for future show
//       dreamContainer.style.opacity = "1";
//     }, 450);
//   });
// });

document.addEventListener("DOMContentLoaded", function () {
  document.addEventListener("click", function (e) {
    const item = e.target.closest(".dropdown-item");
    if (!item) return;

    const href = item.getAttribute("href");
    const dreamContainer = document.querySelector(".dream-container");
    if (!dreamContainer) return;

    // Only animate if the link actually navigates
    if (href && href !== "#" && href !== "javascript:;" && href.trim() !== "") {
      e.preventDefault(); // stop immediate navigation

      // Start fade-out
      dreamContainer.style.transition = "opacity 0.45s ease";
      dreamContainer.style.opacity = "0";

      // After fade, hide section
      setTimeout(() => {
        dreamContainer.style.display = "none";
      }, 450);

      // Then navigate slightly after the animation
      setTimeout(() => {
        window.location.href = href;
      }, 500);
    } else {
      // If it’s not a real link, just hide the section
      dreamContainer.style.transition = "opacity 0.45s ease";
      dreamContainer.style.opacity = "0";
      setTimeout(() => {
        dreamContainer.style.display = "none";
      }, 450);
    }
  });
});
