<header class="site-header">
    @php
        $isHome = request()->path() === '/';
    @endphp
    <div class="container nav-shell">
        <a class="brand" href="{{ $isHome ? '#inicio' : url('/') }}" aria-label="Ir al inicio">
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
            <a href="{{ $isHome ? '#servicios' : url('/#servicios') }}">Planes / Servicios</a>
            <a href="{{ $isHome ? '#contacto' : url('/#contacto') }}">Contactanos</a>
            @auth
                <a class="menu-quote" href="{{ route('cotiza.index') }}">Cotiza tu pagina</a>
            @endauth

            @guest
                <a class="menu-quote" href="{{ route('auth.show', ['mode' => 'login']) }}">Cotiza tu pagina</a>
            @endguest
            @guest
                <a class="menu-cta" href="{{ route('auth.show') }}">Iniciar sesion</a>
            @endguest
            @auth
                <a class="menu-cta" href="{{ route('auth.show') }}">CUENTA</a>
            @endauth
        </nav>
    </div>
</header>
