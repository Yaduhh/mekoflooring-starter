document.addEventListener("DOMContentLoaded", function () {
    const navbarToggle = document.getElementById("navbarToggle");
    const mobileMenu = document.getElementById("mobileMenu");

    // Toggle mobile menu visibility
    navbarToggle.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
    });
});
