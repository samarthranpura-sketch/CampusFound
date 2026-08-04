console.log("Loaded Successfully");
// ------ Mobile Navigation Menu ----------

const menuToggle = document.getElementById("menu-toggle");
const navLinks = document.querySelector(".nav-links");
const navButtons = document.querySelector(".nav-buttons");

if (menuToggle) {
    menuToggle.addEventListener("click", () => {
        navLinks.classList.toggle("active");
        navButtons.classList.toggle("active");
    });
}