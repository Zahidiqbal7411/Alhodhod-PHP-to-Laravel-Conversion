document.addEventListener("DOMContentLoaded", function () {
  const allDropdowns = document.querySelectorAll(".dropdown");

  allDropdowns.forEach(dropdown => {
    const menu = dropdown.querySelector(".dropdown-menu");
    if (!menu) return;

    // Hide menu initially
    menu.classList.remove("show");

    dropdown.addEventListener("mouseenter", () => {
      menu.classList.add("show");
    });

    dropdown.addEventListener("mouseleave", () => {
      menu.classList.remove("show");
    });

    menu.addEventListener("click", e => {
      e.stopPropagation();
    });
  });

  // Clicking outside closes all menus
  document.addEventListener("click", () => {
    document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
      menu.classList.remove("show");
    });
  });
});
