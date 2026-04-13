<header class="site-header">
    <div class="container nav-shell">
        <a class="brand" href="#inicio" aria-label="Ir al inicio">
            @if (file_exists(public_path('images/monotech.png')))
                <img class="brand-logo" src="{{ asset('images/monotech.png') }}" alt="Logo GoriTech">
            @else
                <span class="brand-mark" aria-hidden="true"></span>
            @endif
            <span class="brand-text">GoriTech</span>
        </a>

        <button class="menu-toggle" id="menu-toggle" type="button" aria-label="Abrir menu" aria-controls="menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="menu" id="menu" aria-label="Navegacion principal">
            <a href="#servicios">Planes / Servicios</a>
            <a href="#contacto">Contactanos</a>
        </nav>
    </div>
</header>
