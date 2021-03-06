const navMenu = document.getElementById("nav-menu"),
  toggler = document.getElementById("nav-toggler"),
  closeMenu = document.getElementById("nav-close");

toggler.addEventListener("click", () => {
  navMenu.classList.toggle("show-nav");
  toggler.classList.add("d-none");
});

closeMenu.addEventListener("click", () => {
  navMenu.classList.remove("show-nav");
  toggler.classList.remove("d-none");
});

const navDropdown = document.getElementById("nav-dropdown"),
  navDropContent = document.getElementById("nav-dropdown-content");

navDropdown.addEventListener("click", () => {
  navDropContent.classList.toggle("nav-drop-active");
})
