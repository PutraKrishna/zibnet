const menu = document.getElementById("menu");
const closeMenu = document.getElementById("close");
const nav = document.getElementById("nav");
const sidebar = document.getElementById("sidebar");
const menuSidebar = document.querySelectorAll(".menuSidebar");
const body = document.body;

const slider = document.getElementById("testimonial-slider");
const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");

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


let index = 0;
  const totalSlides = slider.children.length;

  nextBtn.addEventListener("click", () => {
    if (index < totalSlides - 1) {
      index++;
      slider.style.transform = `translateX(-${index * 100}%)`;
    }
  });

  prevBtn.addEventListener("click", () => {
    if (index > 0) {
      index--;
      slider.style.transform = `translateX(-${index * 100}%)`;
    }
  });

// Note :
// stop scrolling css
// h-full m-0 overflow-hidden
