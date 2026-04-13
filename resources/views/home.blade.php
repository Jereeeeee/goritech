@extends('layouts.app')

@section('content')
<section id="inicio" class="hero-section">
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="eyebrow">GoriTech | Soluciones Tecnologicas</p>
            <h1>Nacimos para cumplir el sueño de nuestros clientes: modernizar su negocio con tecnologia.</h1>
            <p class="lead">
                Somos una empresa creada a partir de nuestra pasion por ayudar a emprendedores y negocios a dar el salto digital con paginas web profesionales y soluciones tecnologicas utiles.
            </p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#contacto">Solicitar asesoria</a>
                <a class="btn btn-ghost" href="#servicios">Ver servicios</a>
            </div>
            <div class="hero-tags" aria-label="Fortalezas de GoriTech">
                <span>Paginas web modernas</span>
                <span>Soluciones tecnologicas</span>
                <span>Trabajo personalizado y único</span>
            </div>
        </div>

        <aside class="hero-media" aria-label="Identidad visual de GoriTech">
            @if (file_exists(public_path('images/textotech.png')))
                <img class="hero-logo" src="{{ asset('images/textotech.png') }}" alt="Identidad visual corporativa de GoriTech">
            @else
                <div class="hero-logo-fallback" aria-hidden="true">GT</div>
            @endif
            <div class="hero-media-note" role="note" aria-label="Detalle de identidad visual">
                <p class="hero-media-label">Identidad Visual</p>
                <h3>Aplicada al sitio corporativo</h3>
                <p>Una presencia digital coherente con la marca, profesional y lista para crecer.</p>
            </div>
        </aside>
    </div>
</section>

<section id="sobre-nosotros" class="content-section">
    <div class="container split-grid">
        <div>
            <p class="section-tag">Sobre Nosotros</p>
            <h2>Somos informaticos con ambicion de crecer junto a nuestros clientes, para crecer juntos.</h2>
        </div>
        <p>
            En GoriTech unimos vision, experiencia tecnica y compromiso humano. Nacimos para acompañar a cada cliente en su proceso de modernizacion con paginas web y soluciones tecnologicas, brindando siempre un servicio personalizado, cercano y profesional.
        </p>
    </div>
</section>

<section id="servicios" class="content-section section-surface">
    <div class="container">
        <p class="section-tag">Nuestros Planes / Servicios</p>
        <h2>Servicios pensados para cada etapa del camino digital.</h2>

        <div class="services-grid">
            <article class="service-card">
                <h3>Plan Base</h3>
                <p>Ideal para negocios que quieren comenzar su modernizacion con una web clara y profesional.</p>
                <ul>
                    <li>Landing page de presentacion</li>
                    <li>Estructura optimizada para buscadores</li>
                    <li>Acompanamiento en publicacion</li>
                </ul>
            </article>

            <article class="service-card featured">
                <p class="badge">Recomendado</p>
                <h3>Plan Growth</h3>
                <p>Para empresas que quieren crecer y conectar mejor con sus clientes en el entorno digital.</p>
                <ul>
                    <li>Sitio multi-seccion en Laravel</li>
                    <li>Integraciones de contacto y gestion</li>
                    <li>Analitica para tomar decisiones</li>
                </ul>
            </article>

            <article class="service-card">
                <h3>Plan Scale</h3>
                <p>Enfocado en negocios que buscan evolucion constante con tecnologia a medida.</p>
                <ul>
                    <li>Desarrollo de modulos personalizados</li>
                    <li>Optimizacion de rendimiento</li>
                    <li>Soporte evolutivo continuo</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<section id="contacto" class="content-section">
    <div class="container contact-shell">
        <div>
            <p class="section-tag">Contactanos</p>
            <h2>Cuentanos tu sueño y construyamos juntos la modernizacion de tu negocio.</h2>
            <p>Te orientamos con una propuesta clara para llevar tu idea a una pagina web o solucion tecnologica real y funcional.</p>
        </div>

        <form class="contact-form" action="#" method="post">
            @csrf
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" type="text" placeholder="Tu nombre" required>

            <label for="email">Correo</label>
            <input id="email" name="email" type="email" placeholder="tu@email.com" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje" rows="4" placeholder="Describe brevemente tu necesidad"></textarea>

            <button type="submit" class="btn btn-primary">Enviar consulta</button>
        </form>
    </div>
</section>
@endsection
