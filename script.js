const menu = document.getElementById("menu");
const closeMenu = document.getElementById("close");
const nav = document.getElementById("nav");
const sidebar = document.getElementById("sidebar");
const menuSidebar = document.querySelectorAll(".menuSidebar");
const body = document.body;

menu.addEventListener("click", function () {
  sidebar.classList.toggle("hidden");
  body.classList.toggle("h-full");
  body.classList.toggle("m-0");
  body.classList.toggle("overflow-hidden");
});

closeMenu.addEventListener("click", function () {
  sidebar.classList.toggle("hidden");
  body.classList.toggle("h-full");
  body.classList.toggle("m-0");
  body.classList.toggle("overflow-hidden");
});

for (i = 0; i < menuSidebar.length; i++) {
  menuSidebar[i].addEventListener("click", function () {
    sidebar.classList.toggle("hidden");
    body.classList.toggle("h-full");
    body.classList.toggle("m-0");
    body.classList.toggle("overflow-hidden");

  });
}
// Note :
// stop scrolling css
// h-full m-0 overflow-hidden
