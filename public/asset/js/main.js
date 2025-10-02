const languageBtn = document.getElementById("dropdownMenuButton1");
const languageDropdown = document.getElementsByClassName("dropdown-menu")[0];

languageDropdown.classList.add("hidden");

languageBtn.addEventListener("click", () => {
  languageDropdown.classList.toggle("hidden");
});
