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

<section id="servicios" class="content-section section-clear">
    <div class="container">
        <p class="section-tag">Nuestros Planes / Servicios</p>
        <h2>Servicios pensados para cada etapa del camino digital.</h2>

        <div class="services-grid">
            <article class="service-card">
                <svg class="service-card-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 3h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 8v6M9 11h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3>Landing Page</h3>
                <p class="service-category">CAMPAÑAS & PUBLICIDAD</p>
                <p class="service-price">Desde $250.000</p>
                <p>Pensado para emprendedores que necesitan iniciar su presencia digital con una base profesional y ordenada.</p>
                <ul>
                    <li>Landing page de presentación con identidad de marca</li>
                    <li>Diseño responsive para móvil y escritorio</li>
                    <li>Configuración inicial y acompañamiento de salida</li>
                </ul>
            </article>

            <article class="service-card featured">
                <svg class="service-card-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12h18M7 9v6m3-6v6m3-6v6m3-6v6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21 7v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3>Sitio Corporativo</h3>
                <p class="service-category">PYMES & SERVICIOS</p>
                <p class="badge">Recomendado</p>
                <p class="service-price">Desde $350.000</p>
                <p>Ideal para negocios en crecimiento que requieren una web sólida para vender mejor y generar confianza.</p>
                <ul>
                    <li>Sitio web multi-sección con enfoque comercial (Inicio, Nosotros, Servicios, Contacto).</li>
                    <li>Genera confianza institucional y posicionamiento de marca.</li>
                    <li>Autoadministrable: Podrás editar textos e imágenes tú mismo.</li>
                </ul>
            </article>

            <article class="service-card">
                <svg class="service-card-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                    <path d="M12 6v2m0 8v2M6 12H4m8 0h2M8.2 8.2l1.4 1.4m5.2 5.2l1.4 1.4M8.2 15.8l1.4-1.4m5.2-5.2l1.4-1.4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3>Tienda Online</h3>
                <p class="service-category">VENTAS AUTOMÁTICAS</p>
                <p class="service-price">Desde $450.000</p>
                <p>Orientado a empresas que quieren escalar con soluciones tecnológicas personalizadas y evolución continua.</p>
                <ul>
                    <li>Catálogo de productos con carrito de compras y gestión de stock.</li>
                    <li>Pagos en línea integrados (Webpay, MercadoPago) y cálculo de envíos.</li>
                    <li>Tu sucursal digital abierta 24/7 vendiendo en automático.</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<div class="section-divider" aria-hidden="true">
    <span></span>
</div>

<section id="por-que-somos-mejores" class="content-section section-gray better-section">
    <div class="container">
        <p class="section-tag">Por Que Somos Mejores</p>
        <h2>Trabajo profesional, a medida y pensado para tu negocio.</h2>

        <div class="comparison-grid">
            <article class="comparison-card better">
                <h3>Como trabaja GoriTech</h3>
                <ul>
                    <li>Analizamos tu negocio y diseniamos una solucion personalizada.</li>
                    <li>Cada pagina y modulo se desarrolla a medida de tus objetivos.</li>
                    <li>Arquitectura profesional, escalable y preparada para crecer.</li>
                    <li>Acompanamiento cercano durante y despues de la entrega.</li>
                </ul>
            </article>

            <article class="comparison-card standard">
                <h3>Servicios basados en plantillas</h3>
                <ul>
                    <li>Diseños genericos que no reflejan la identidad de tu marca.</li>
                    <li>Limitaciones al momento de agregar nuevas funciones.</li>
                    <li>Menor flexibilidad para adaptar procesos reales del negocio.</li>
                    <li>Resultados poco diferenciales frente a la competencia.</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<div class="section-divider" aria-hidden="true">
    <span></span>
</div>

<section id="contacto" class="content-section section-clear">
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
