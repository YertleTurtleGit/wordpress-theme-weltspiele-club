"use strict";

console.log("script running.");

const toggleNavButtons = Array.from(
   document.getElementsByClassName("toggle-nav")
);

toggleNavButtons.forEach((toggleNavButton, index) => {
   toggleNavButton.addEventListener("click", (listener) => {
      const menu = document.getElementsByClassName("menu-collapse")[index];
      if (toggleNavButton.innerText === "☰") {
         toggleNavButton.innerText = "✕";
         menu.style.display = "inherit";
         menu.style.opacity = "1";
         document.body.style.overflow = "hidden";
      } else {
         toggleNavButton.innerText = "☰";
         menu.style.opacity = "0";
         menu.style.display = "none";
         document.body.style.overflow = "auto";
      }
      listener.preventDefault();
   });
});

toggleNavButtons.forEach((toggleNavButton, index) => {
   const menu = document.getElementsByClassName("menu-collapse")[index];
   toggleNavButton.innerText = "☰";
   menu.style.opacity = "0";
   menu.style.display = "none";
});
