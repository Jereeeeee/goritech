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
    const quoteForm = cotizaModule.querySelector("[data-quote-form]");
    const payloadMin = cotizaModule.querySelector("[data-quote-payload-min]");
    const payloadMax = cotizaModule.querySelector("[data-quote-payload-max]");
    const payloadAvg = cotizaModule.querySelector("[data-quote-payload-avg]");
    const payloadItems = cotizaModule.querySelector("[data-quote-payload-items]");
    const payloadFactors = cotizaModule.querySelector("[data-quote-payload-factors]");
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

        if (payloadMin instanceof HTMLInputElement) {
            payloadMin.value = String(totalMin);
        }

        if (payloadMax instanceof HTMLInputElement) {
            payloadMax.value = String(totalMax);
        }

        if (payloadAvg instanceof HTMLInputElement) {
            payloadAvg.value = String(totalAvg);
        }

        if (payloadItems instanceof HTMLInputElement) {
            payloadItems.value = JSON.stringify(selected);
        }

        if (payloadFactors instanceof HTMLInputElement) {
            payloadFactors.value = JSON.stringify([...factors]);
        }

        if (quoteSend instanceof HTMLButtonElement) {
            quoteSend.disabled = selected.length === 0;
        }
    };

    quoteInputs.forEach((input) => {
        input.addEventListener("change", syncSummary);
    });

    if (quoteForm instanceof HTMLFormElement) {
        quoteForm.addEventListener("submit", (event) => {
            if (quoteSend instanceof HTMLButtonElement && quoteSend.disabled) {
                event.preventDefault();
            }
        });
    }

    syncSummary();

    const quoteSuccessModal = cotizaModule.querySelector("[data-quote-success-modal]");
    const quoteSuccessClose = cotizaModule.querySelectorAll("[data-quote-success-close]");

    const closeQuoteSuccessModal = () => {
        if (!(quoteSuccessModal instanceof HTMLElement)) {
            return;
        }

        quoteSuccessModal.classList.remove("open");
        quoteSuccessModal.setAttribute("aria-hidden", "true");
    };

    quoteSuccessClose.forEach((trigger) => {
        trigger.addEventListener("click", closeQuoteSuccessModal);
    });
}

const adminModule = document.querySelector("[data-admin-page]");

if (adminModule) {
    const adminModal = adminModule.querySelector("[data-admin-modal]");
    const openButtons = adminModule.querySelectorAll("[data-admin-open]");
    const closeTriggers = adminModule.querySelectorAll("[data-admin-close]");

    const modalId = adminModule.querySelector("[data-admin-modal-id]");
    const modalFecha = adminModule.querySelector("[data-admin-modal-fecha]");
    const modalCliente = adminModule.querySelector("[data-admin-modal-cliente]");
    const modalCorreo = adminModule.querySelector("[data-admin-modal-correo]");
    const modalTelefono = adminModule.querySelector("[data-admin-modal-telefono]");
    const modalMinimo = adminModule.querySelector("[data-admin-modal-minimo]");
    const modalMaximo = adminModule.querySelector("[data-admin-modal-maximo]");
    const modalPromedio = adminModule.querySelector("[data-admin-modal-promedio]");
    const modalItems = adminModule.querySelector("[data-admin-modal-items]");
    const modalFactores = adminModule.querySelector("[data-admin-modal-factores]");
    const modalComentario = adminModule.querySelector("[data-admin-modal-comentario]");
    const modalMensaje = adminModule.querySelector("[data-admin-modal-mensaje]");
    const factorsToggle = adminModule.querySelector("[data-admin-factors-toggle]");
    const factorsContent = adminModule.querySelector("[data-admin-factors-content]");

    const money = new Intl.NumberFormat("es-CL", {
        style: "currency",
        currency: "CLP",
        maximumFractionDigits: 0,
    });

    const closeAdminModal = () => {
        if (!(adminModal instanceof HTMLElement)) {
            return;
        }

        adminModal.classList.remove("open");
        adminModal.setAttribute("aria-hidden", "true");
    };

    const renderList = (container, entries, mapFn, emptyMessage) => {
        if (!(container instanceof HTMLElement)) {
            return;
        }

        container.innerHTML = "";

        if (!entries.length) {
            const li = document.createElement("li");
            li.textContent = emptyMessage;
            container.appendChild(li);
            return;
        }

        entries.map(mapFn).forEach((li) => container.appendChild(li));
    };

    const openAdminModal = (payload) => {
        if (!(adminModal instanceof HTMLElement)) {
            return;
        }

        if (modalId) {
            modalId.textContent = `#${payload.id ?? "-"}`;
        }

        if (modalFecha) {
            modalFecha.textContent = payload.fecha ? `Creada: ${payload.fecha}` : "";
        }

        if (modalCliente) {
            modalCliente.textContent = payload.cliente ?? "Sin nombre";
        }

        if (modalCorreo) {
            modalCorreo.textContent = payload.correo ?? "Sin correo";
        }

        if (modalTelefono) {
            modalTelefono.textContent = payload.telefono ?? "Sin telefono";
        }

        if (modalMinimo) {
            modalMinimo.textContent = money.format(Number(payload.minimo || 0));
        }

        if (modalMaximo) {
            modalMaximo.textContent = money.format(Number(payload.maximo || 0));
        }

        if (modalPromedio) {
            modalPromedio.textContent = money.format(Number(payload.promedio || 0));
        }

        renderList(
            modalItems,
            Array.isArray(payload.items) ? payload.items : [],
            (item) => {
                const li = document.createElement("li");
                const name = item?.name || "Item";
                const min = money.format(Number(item?.min || 0));
                const max = money.format(Number(item?.max || 0));
                li.textContent = `${name}: ${min} - ${max}`;
                return li;
            },
            "Sin items registrados."
        );

        renderList(
            modalFactores,
            Array.isArray(payload.factores) ? payload.factores : [],
            (factor) => {
                const li = document.createElement("li");
                li.textContent = String(factor);
                return li;
            },
            "Sin factores registrados."
        );

        if (modalComentario) {
            modalComentario.textContent = payload.comentario || "Sin comentario registrado.";
        }

        if (modalMensaje) {
            modalMensaje.textContent = payload.mensajeConfirmacion || "Sin mensaje registrado.";
        }

        if (factorsContent instanceof HTMLElement && factorsToggle instanceof HTMLButtonElement) {
            factorsContent.hidden = true;
            factorsToggle.setAttribute("aria-expanded", "false");
            factorsToggle.querySelector(".admin-accordion-icon").textContent = "+";
        }

        adminModal.classList.add("open");
        adminModal.setAttribute("aria-hidden", "false");
    };

    openButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const card = button.closest("[data-admin-card]");
            const payloadNode = card?.querySelector("[data-admin-payload]");

            if (!(payloadNode instanceof HTMLScriptElement)) {
                return;
            }

            try {
                const payload = JSON.parse(payloadNode.textContent || "{}");
                openAdminModal(payload);
            } catch {
                // Do nothing if payload is invalid.
            }
        });
    });

    closeTriggers.forEach((trigger) => {
        trigger.addEventListener("click", closeAdminModal);
    });

    if (factorsToggle instanceof HTMLButtonElement && factorsContent instanceof HTMLElement) {
        factorsToggle.addEventListener("click", () => {
            const isOpen = !factorsContent.hidden;
            factorsContent.hidden = isOpen;
            factorsToggle.setAttribute("aria-expanded", String(!isOpen));

            const icon = factorsToggle.querySelector(".admin-accordion-icon");
            if (icon) {
                icon.textContent = isOpen ? "+" : "−";
            }
        });
    }

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closeAdminModal();
        }
    });
}
