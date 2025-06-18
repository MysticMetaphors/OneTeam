import './bootstrap';
// import '../css/app.css';

// if (window.location.pathname.includes('/login')) {
//     import('../css/Auth.css');
// } else if (window.location.pathname.includes('Dashboard')) {
//     import('../css/Main.css');
// }

window.openModal = openModal;

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
    menuToggler.querySelector("span").innerText = isMenuActive ? "menu" : "close";
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
        root.style.setProperty('--search-bar-bg', '#151a2da5')
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
        root.style.setProperty('--search-bar-bg', '#f1faff86')
    }
});

function DateConvert(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString(undefined, {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        // hour: 'numeric',
        // minute: '2-digit'
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const dateElements = document.querySelectorAll('.convertDate');

    dateElements.forEach(el => {
        const rawDate = el.dataset.date;
        if (rawDate) {
            const formatted = DateConvert(rawDate);
            el.textContent = formatted;
        }
    });

    // Generic modal handler for any modal with data-modal-target and data-modal-close attributes
});

const taskTablebtn = document.getElementById('task-view-btn');
const kanbanTablebtn = document.getElementById('kanban-view-btn');

const taskTable = document.getElementById('task-table-view');
const kanbanTable = document.getElementById('kanban-view');

if (kanbanTablebtn && taskTablebtn && kanbanTable && taskTable) {
    kanbanTablebtn.addEventListener('click', () => {
        kanbanTable.style.display = "flex";
        taskTable.style.display = "none";

        taskTablebtn.classList.remove('btn-border');
        kanbanTablebtn.classList.add('btn-border');
    });

    taskTablebtn.addEventListener('click', () => {
        taskTable.style.display = "block";
        kanbanTable.style.display = "none";

        kanbanTablebtn.classList.remove('btn-border');
        taskTablebtn.classList.add('btn-border');
    });
}

const toggleSubmenu = document.querySelectorAll('.submenu-toggler');
toggleSubmenu.forEach(toggler => {
    toggler.addEventListener('click', (e) => {
        e.preventDefault();
        const submenu = toggler.closest('.nav-item').querySelector('.submenu');
        submenu.classList.toggle('open-submenu');
        const icon = toggler;
        icon.classList.toggle('rotate-180');
    });
});

function openModal(modalId, title, desc, attach, due, status, sub) {
    const modal = document.getElementById(modalId);
    const titleCon = document.querySelector('.task-title');
    const descCon = document.querySelector('.task-desc');
    const duecCon = document.querySelector('.task-date');
    const statusCon = document.querySelector('.modal-tag');
    // const attachCon = document.getElementsByClassName('task-title');
    const subCon = document.querySelector('.task-sub');
    if (!modal) return console.log('failed', modal);

    if (title) {
        titleCon.innerHTML = title;
        descCon.innerHTML = desc;
        duecCon.textContent = DateConvert(due);
        statusCon.textContent = status;

        const subArray = JSON.parse(sub);
        subCon.innerHTML = subArray.map((item) => `
            <div class="checkbox-input">
                <input type="checkbox" value="${item.id}">
                <span>${item.title}</span>
            </div>
        `).join("");
    }

    modal.style.display = "block";
    if (!modal.dataset.listenersAdded) {
        modal.querySelectorAll('[data-modal-close]').forEach(closeBtn => {
            closeBtn.addEventListener('click', () => {
                modal.style.display = "none";
            });
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        modal.dataset.listenersAdded = "true";
    }
}
