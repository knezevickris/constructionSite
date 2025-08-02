document.addEventListener("DOMContentLoaded", function () {
    const submenus = document.querySelectorAll(".navbar .dropdown .dropdown");

    submenus.forEach(function (submenu) {
        submenu.addEventListener("mouseenter", function () {
            const submenuList = submenu.querySelector("ul");

            submenuList.style.left = "100%";
            submenuList.style.right = "auto";

            requestAnimationFrame(() => {
                const rect = submenuList.getBoundingClientRect();

                if (rect.right > window.innerWidth) {
                    submenuList.style.left = "auto";
                    submenuList.style.right = "100%";
                }
            });
        });
    });
});