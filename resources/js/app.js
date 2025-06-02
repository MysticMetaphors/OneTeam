import './bootstrap';

const sidebar = document.querySelector(".sidebar");
const sidebarToggler = document.querySelector(".sidebar-toggler");
const menuToggler = document.querySelector(".menu-toggler");

let collapsedSidebarHeight = "56px";
let fullSidebarHeight = "calc(100vh - 32px)";

sidebarToggler.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");
});

const toggleMenu = (isMenuActive) => {
    sidebar.style.height = isMenuActive ? `${sidebar.scrollHeight}px` : collapsedSidebarHeight;
    menuToggler.querySelector("span").innerText = isMenuActive ? "close" : "menu";
}

menuToggler.addEventListener("click", () => {
    toggleMenu(sidebar.classList.toggle("menu-active"));
});

window.addEventListener("resize", () => {
    if (window.innerWidth >= 1024) {
        sidebar.style.height = fullSidebarHeight;
    } else {
        sidebar.classList.remove("collapsed");
        sidebar.style.height = "auto";
        toggleMenu(sidebar.classList.contains("menu-active"));
    }
});

// Theme toggle functionality
const themeToggle = document.querySelector(".theme-toggle");
themeToggle.addEventListener("click", () => {
    const isLightMode = document.body.classList.toggle("lightmode");
    // const themeToggleSpan = themeToggle.querySelector("span");
    // if (themeToggleSpan) {
    //     themeToggleSpan.innerText = isLightMode ? "&#xe51c;" : "&#xe51d;";
    // }

    // Change theme icon
    const moonIcon = document.getElementById('moonIcon');
    const sunIcon = document.getElementById('sunIcon');
    if (isLightMode) {
        moonIcon.style.display = "none";
        sunIcon.style.display = "flex";
    } else {
        moonIcon.style.display = "flex";
        sunIcon.style.display = "none";
    }

    const root = document.documentElement;
    if (isLightMode) {
        root.style.setProperty('--background-color', '#F1FAFF');
        root.style.setProperty('--background-gradient-end', '#CBE4FF');
        root.style.setProperty('--sidebar-bg', '#fff');
        root.style.setProperty('--font-color', '#151A2D');
        root.style.setProperty('--sidebar-font-color', '#151A2D');
        root.style.setProperty('--inverted-image', 'invert(0%)');
        root.style.setProperty('--hover-bg', '#151A2D');
        root.style.setProperty('--hover-font-color', '#ffffff');
        root.style.setProperty('--toggler-bg', '#151A2D');
    } else {
        root.style.setProperty('--background-color', '#151A2D');
        root.style.setProperty('--background-gradient-end', '#1E213F');
        root.style.setProperty('--sidebar-bg', '#1E213F');
        root.style.setProperty('--font-color', '#ffffff');
        root.style.setProperty('--sidebar-font-color', '#ffffff');
        root.style.setProperty('--inverted-image', 'invert(100%)');
        root.style.setProperty('--hover-bg', '#ffffff');
        root.style.setProperty('--hover-font-color', '#151A2D');
        root.style.setProperty('--toggler-bg', '#ffffff');
    }
});
