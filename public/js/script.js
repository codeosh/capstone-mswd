document.addEventListener("DOMContentLoaded", function () {
  AOS.init();
  AOS.refresh();
});

//Menu Bar Responsive
function toggleMobileMenu() {
  const navLinks = document.getElementById("nav-links");
  navLinks.classList.toggle("active");
}

document
  .getElementById("bars-menu")
  .addEventListener("click", toggleMobileMenu);
