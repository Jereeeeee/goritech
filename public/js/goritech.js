const menuToggle = document.getElementById("menu-toggle");
const menu = document.getElementById("menu");

if (menuToggle && menu) {
    menuToggle.addEventListener("click", () => {
        const isOpen = menu.classList.toggle("open");
        menuToggle.setAttribute("aria-expanded", String(isOpen));
    });

    menu.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", () => {
            menu.classList.remove("open");
            menuToggle.setAttribute("aria-expanded", "false");
        });
    });
}

const sectionLinks = document.querySelectorAll(".menu a");
const sections = document.querySelectorAll("section[id]");

if (sectionLinks.length && sections.length) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                sectionLinks.forEach((link) => {
                    const linkTarget = link.getAttribute("href");
                    const isActive = linkTarget === `#${entry.target.id}`;
                    link.classList.toggle("active", isActive);
                });
            });
        },
        {
            threshold: 0.45,
        }
    );

    sections.forEach((section) => observer.observe(section));
}

const authShell = document.querySelector("[data-auth-shell]");

if (authShell) {
    const authButtons = authShell.querySelectorAll("[data-auth-switch]");
    const syncAuthMode = (mode) => {
        authShell.classList.toggle("register-mode", mode === "register");
        authShell.classList.toggle("login-mode", mode !== "register");

        authButtons.forEach((button) => {
            button.classList.toggle("active", button.dataset.authSwitch === mode);
        });
    };

    authButtons.forEach((button) => {
        button.addEventListener("click", () => syncAuthMode(button.dataset.authSwitch || "login"));
    });

    syncAuthMode(authShell.dataset.authMode || "login");
}
