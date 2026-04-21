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

const cotizaModule = document.querySelector("[data-cotiza]");

if (cotizaModule) {
    const currencyFormatter = new Intl.NumberFormat("es-CL", {
        style: "currency",
        currency: "CLP",
        maximumFractionDigits: 0,
    });

    const quoteInputs = [...cotizaModule.querySelectorAll("[data-quote-input]")];
    const selectedCount = cotizaModule.querySelector("[data-quote-selected-count]");
    const quoteSummaryList = cotizaModule.querySelector("[data-quote-summary-list]");
    const quoteTotalMin = cotizaModule.querySelector("[data-quote-total-min]");
    const quoteTotalMax = cotizaModule.querySelector("[data-quote-total-max]");
    const quoteTotalAvg = cotizaModule.querySelector("[data-quote-total-avg]");
    const quoteFactorList = cotizaModule.querySelector("[data-quote-factor-list]");
    const quoteSend = cotizaModule.querySelector("[data-quote-send]");

    const formatMoney = (value) => currencyFormatter.format(value);

    const replaceChildren = (container, nodes) => {
        if (!container) {
            return;
        }

        container.innerHTML = "";
        nodes.forEach((node) => container.appendChild(node));
    };

    const buildSummaryItem = (entry) => {
        const row = document.createElement("div");
        row.className = "quote-summary-item";

        const left = document.createElement("div");
        left.className = "quote-summary-title";

        const title = document.createElement("span");
        title.textContent = entry.name;

        const meta = document.createElement("small");
        meta.textContent = `Complejidad: ${entry.complexity}`;

        left.appendChild(title);
        left.appendChild(meta);

        const range = document.createElement("strong");
        range.textContent = `${formatMoney(entry.min)} - ${formatMoney(entry.max)}`;

        row.appendChild(left);
        row.appendChild(range);

        return row;
    };

    const syncSummary = () => {
        let totalMin = 0;
        let totalMax = 0;
        let totalAvg = 0;
        const selected = [];
        const factors = new Set();

        quoteInputs.forEach((input) => {
            if (!(input instanceof HTMLInputElement) || !input.checked) {
                return;
            }

            const min = Number(input.dataset.priceMin || 0);
            const max = Number(input.dataset.priceMax || 0);
            const avg = Math.round((min + max) / 2);

            totalMin += min;
            totalMax += max;
            totalAvg += avg;

            selected.push({
                name: input.dataset.optionName || "",
                min,
                max,
                complexity: input.dataset.complexity || "Medio",
            });

            if (input.dataset.reason) {
                factors.add(input.dataset.reason);
            }
        });

        if (selectedCount) {
            selectedCount.textContent = String(selected.length);
        }

        if (quoteSummaryList) {
            if (!selected.length) {
                const empty = document.createElement("p");
                empty.className = "quote-empty";
                empty.textContent = "Aun no seleccionas funcionalidades.";
                replaceChildren(quoteSummaryList, [empty]);
            } else {
                replaceChildren(quoteSummaryList, selected.map(buildSummaryItem));
            }
        }

        if (quoteTotalMin) {
            quoteTotalMin.textContent = formatMoney(totalMin);
        }

        if (quoteTotalMax) {
            quoteTotalMax.textContent = formatMoney(totalMax);
        }

        if (quoteTotalAvg) {
            quoteTotalAvg.textContent = formatMoney(totalAvg);
        }

        if (quoteFactorList) {
            const factorItems = [...factors].map((factor) => {
                const li = document.createElement("li");
                li.textContent = factor;
                return li;
            });

            if (!factorItems.length) {
                const fallback = document.createElement("li");
                fallback.textContent = "Selecciona funcionalidades para ver factores de complejidad.";
                replaceChildren(quoteFactorList, [fallback]);
            } else {
                replaceChildren(quoteFactorList, factorItems);
            }
        }

        if (quoteSend instanceof HTMLButtonElement) {
            quoteSend.disabled = selected.length === 0;
        }
    };

    quoteInputs.forEach((input) => {
        input.addEventListener("change", syncSummary);
    });

    syncSummary();
}
