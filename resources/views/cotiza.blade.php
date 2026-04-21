@extends('layouts.app')

@section('content')
@php
    $quoteCatalog = [
        [
            'id' => 'secciones',
            'label' => 'Secciones de la pagina',
            'description' => 'Cada bloque visual y de contenido se cotiza por separado para construir una web modular.',
            'items' => [
                [
                    'id' => 'hero',
                    'name' => 'Hero',
                    'description' => 'Portada principal con imagen, texto y boton de accion (CTA).',
                    'min' => 30000,
                    'max' => 100000,
                    'complexity' => 'Medio',
                    'reason' => 'Sube por calidad visual, animaciones y refinamiento del mensaje comercial.',
                ],
                [
                    'id' => 'sobre-nosotros',
                    'name' => 'Sobre nosotros',
                    'description' => 'Seccion institucional para historia, propuesta de valor y equipo.',
                    'min' => 20000,
                    'max' => 60000,
                    'complexity' => 'Basico',
                    'reason' => 'Aumenta por cantidad de bloques de contenido, imagenes y estructura narrativa.',
                ],
                [
                    'id' => 'servicios',
                    'name' => 'Servicios',
                    'description' => 'Seccion para presentar y destacar servicios con enfoque comercial.',
                    'min' => 30000,
                    'max' => 100000,
                    'complexity' => 'Medio',
                    'reason' => 'Varia por cantidad de tarjetas, iconografia y llamados a la accion.',
                ],
                [
                    'id' => 'portafolio-galeria',
                    'name' => 'Portafolio / galeria',
                    'description' => 'Muestra visual de trabajos, proyectos o productos destacados.',
                    'min' => 40000,
                    'max' => 120000,
                    'complexity' => 'Medio',
                    'reason' => 'Sube por volumen de imagenes, filtros y optimizacion multimedia.',
                ],
                [
                    'id' => 'testimonios',
                    'name' => 'Testimonios',
                    'description' => 'Bloque de prueba social con opiniones y validacion de clientes.',
                    'min' => 20000,
                    'max' => 50000,
                    'complexity' => 'Basico',
                    'reason' => 'Incrementa si incluye carrusel, videos o formatos avanzados.',
                ],
                [
                    'id' => 'formulario-contacto',
                    'name' => 'Formulario de contacto',
                    'description' => 'Captura de leads y consultas con campos personalizados.',
                    'min' => 30000,
                    'max' => 80000,
                    'complexity' => 'Medio',
                    'reason' => 'Sube por validaciones, anti-spam y automatizaciones de respuesta.',
                ],
                [
                    'id' => 'faq',
                    'name' => 'FAQ',
                    'description' => 'Preguntas frecuentes para reducir friccion y soporte repetitivo.',
                    'min' => 20000,
                    'max' => 50000,
                    'complexity' => 'Basico',
                    'reason' => 'Aumenta por acordeones avanzados y categorizacion dinámica.',
                ],
                [
                    'id' => 'blog-basico',
                    'name' => 'Blog basico',
                    'description' => 'Publicacion de articulos con estructura inicial para contenido.',
                    'min' => 80000,
                    'max' => 200000,
                    'complexity' => 'Avanzado',
                    'reason' => 'Sube por editor, categorias, etiquetas y plantilla de entradas.',
                ],
                [
                    'id' => 'footer-personalizado',
                    'name' => 'Footer personalizado',
                    'description' => 'Pie de pagina con enlaces, datos legales y contacto.',
                    'min' => 20000,
                    'max' => 60000,
                    'complexity' => 'Basico',
                    'reason' => 'Varia por cantidad de columnas, elementos y adaptacion responsive.',
                ],
            ],
        ],
        [
            'id' => 'diseno',
            'label' => 'Diseno',
            'description' => 'Nivel visual y experiencia de uso de la interfaz.',
            'items' => [
                [
                    'id' => 'diseno-base',
                    'name' => 'Diseno base (plantilla)',
                    'description' => 'Plantilla adaptable para acelerar salida inicial.',
                    'min' => 0,
                    'max' => 50000,
                    'complexity' => 'Basico',
                    'reason' => 'Aumenta segun nivel de ajuste sobre plantilla preexistente.',
                ],
                [
                    'id' => 'diseno-personalizado',
                    'name' => 'Diseno personalizado',
                    'description' => 'Interfaz hecha a medida en base a identidad de marca.',
                    'min' => 100000,
                    'max' => 400000,
                    'complexity' => 'Avanzado',
                    'reason' => 'Sube con profundidad de branding, iteraciones y sistema visual propio.',
                ],
                [
                    'id' => 'responsive',
                    'name' => 'Diseno responsive (movil y tablet)',
                    'description' => 'Adaptacion completa para pantallas pequenas y medianas.',
                    'min' => 50000,
                    'max' => 150000,
                    'complexity' => 'Medio',
                    'reason' => 'Aumenta por cantidad de vistas, componentes y ajustes por dispositivo.',
                ],
            ],
        ],
        [
            'id' => 'funcionalidades',
            'label' => 'Funcionalidades',
            'description' => 'Capas de logica para operar usuarios, contenidos y flujos internos.',
            'items' => [
                [
                    'id' => 'login-usuarios',
                    'name' => 'Sistema de login/registro',
                    'description' => 'Alta e inicio de sesion con validaciones y flujos de acceso.',
                    'min' => 100000,
                    'max' => 300000,
                    'complexity' => 'Medio',
                    'reason' => 'Sube por recuperacion de contrasena, validaciones y politicas de acceso.',
                ],
                [
                    'id' => 'panel-admin',
                    'name' => 'Panel de administracion',
                    'description' => 'Backoffice para gestionar operaciones y contenido del sitio.',
                    'min' => 150000,
                    'max' => 500000,
                    'complexity' => 'Avanzado',
                    'reason' => 'Aumenta por permisos, reportes, filtros y volumen de datos gestionados.',
                ],
                [
                    'id' => 'multiusuario',
                    'name' => 'Multiusuario',
                    'description' => 'Soporte de multiples perfiles o roles con accesos diferenciados.',
                    'min' => 100000,
                    'max' => 300000,
                    'complexity' => 'Avanzado',
                    'reason' => 'Sube segun reglas de permisos y complejidad del modelo de roles.',
                ],
                [
                    'id' => 'buscador-interno',
                    'name' => 'Buscador interno',
                    'description' => 'Busqueda de contenido/productos dentro del sitio.',
                    'min' => 50000,
                    'max' => 150000,
                    'complexity' => 'Medio',
                    'reason' => 'Varia por filtros, relevancia, indexing y volumen de informacion.',
                ],
            ],
        ],
        [
            'id' => 'ecommerce',
            'label' => 'Ecommerce',
            'description' => 'Modulos para vender online con flujo de compra y pago.',
            'items' => [
                [
                    'id' => 'catalogo-productos',
                    'name' => 'Catalogo de productos',
                    'description' => 'Listado de productos con fichas, categorias y navegacion.',
                    'min' => 100000,
                    'max' => 300000,
                    'complexity' => 'Medio',
                    'reason' => 'Aumenta por filtros, variantes y volumen de catalogo.',
                ],
                [
                    'id' => 'carrito-compras',
                    'name' => 'Carrito de compras',
                    'description' => 'Gestion de productos agregados, cantidades y subtotal.',
                    'min' => 150000,
                    'max' => 400000,
                    'complexity' => 'Avanzado',
                    'reason' => 'Sube por reglas de descuento, persistencia y validaciones de stock.',
                ],
                [
                    'id' => 'sistema-pagos',
                    'name' => 'Sistema de pagos',
                    'description' => 'Implementacion de flujo de checkout y confirmacion de pago.',
                    'min' => 200000,
                    'max' => 600000,
                    'complexity' => 'Avanzado',
                    'reason' => 'Aumenta por estados de transaccion, errores y conciliacion.',
                ],
                [
                    'id' => 'webpay',
                    'name' => 'Integracion con Webpay',
                    'description' => 'Conexion especifica con Webpay para cobros en Chile.',
                    'min' => 100000,
                    'max' => 300000,
                    'complexity' => 'Avanzado',
                    'reason' => 'Varia por certificacion, ambiente QA y adaptacion a flujos del negocio.',
                ],
            ],
        ],
        [
            'id' => 'integraciones',
            'label' => 'Integraciones',
            'description' => 'Conexiones externas para mejorar canales de contacto y servicios.',
            'items' => [
                [
                    'id' => 'whatsapp',
                    'name' => 'WhatsApp',
                    'description' => 'Boton o enlace directo para contacto comercial inmediato.',
                    'min' => 10000,
                    'max' => 30000,
                    'complexity' => 'Basico',
                    'reason' => 'Sube por personalizacion de mensajes y reglas de seguimiento.',
                ],
                [
                    'id' => 'redes-sociales',
                    'name' => 'Redes sociales',
                    'description' => 'Integracion de enlaces y widgets sociales en el sitio.',
                    'min' => 10000,
                    'max' => 40000,
                    'complexity' => 'Basico',
                    'reason' => 'Aumenta por cantidad de plataformas y componentes embebidos.',
                ],
                [
                    'id' => 'google-maps',
                    'name' => 'Google Maps',
                    'description' => 'Mapa embebido para ubicacion y referencia geográfica.',
                    'min' => 10000,
                    'max' => 30000,
                    'complexity' => 'Basico',
                    'reason' => 'Varia por estilos de mapa y multiples sucursales.',
                ],
                [
                    'id' => 'api-externa',
                    'name' => 'API externa',
                    'description' => 'Conexion con servicios o sistemas externos mediante API.',
                    'min' => 100000,
                    'max' => 400000,
                    'complexity' => 'Avanzado',
                    'reason' => 'Sube por autenticacion, mapping de datos y manejo de errores.',
                ],
            ],
        ],
    ];
@endphp

<section class="quote-page" data-cotiza>
    <div class="container">
        <p class="section-tag">Cotiza tu pagina</p>
        <h1>Arma tu sitio por funcionalidades y calcula un rango realista de inversion.</h1>
        <p class="quote-intro">Valores referenciales basados en mercado chileno. Selecciona modulos y revisa minimo, maximo y promedio sugerido.</p>

        <div class="quote-help" aria-label="Guia de uso del cotizador">
            <h2>Como usar este cotizador</h2>
            <ol>
                <li>Marca las opciones que quieres para tu pagina web.</li>
                <li>Mira a la derecha el resumen con el total estimado.</li>
                <li>Usa el promedio sugerido como referencia inicial de inversion.</li>
            </ol>
            <p>Este cotizador no es una boleta final. Es una estimacion transparente para ayudarte a decidir que incluir en tu proyecto.</p>
        </div>

        <div class="quote-layout">
            <div class="quote-catalog" aria-label="Opciones de cotizacion por categoria">
                @foreach ($quoteCatalog as $category)
                    <section class="quote-category" aria-labelledby="cat-{{ $category['id'] }}">
                        <div class="quote-category-head">
                            <p class="quote-category-tag">{{ $category['label'] }}</p>
                            <h2 id="cat-{{ $category['id'] }}">{{ $category['label'] }}</h2>
                            <p>{{ $category['description'] }}</p>
                        </div>

                        <div class="quote-grid">
                            @foreach ($category['items'] as $item)
                                @php
                                    $suggested = (int) round(($item['min'] + $item['max']) / 2);
                                @endphp
                                <article class="quote-item">
                                    <label class="quote-option-card" for="feature-{{ $item['id'] }}">
                                        <div class="quote-option-top">
                                            <input
                                                id="feature-{{ $item['id'] }}"
                                                type="checkbox"
                                                data-quote-input
                                                data-option-id="{{ $item['id'] }}"
                                                data-option-name="{{ $item['name'] }}"
                                                data-price-min="{{ $item['min'] }}"
                                                data-price-max="{{ $item['max'] }}"
                                                data-complexity="{{ $item['complexity'] }}"
                                                data-reason="{{ $item['reason'] }}"
                                            >
                                            <h3>{{ $item['name'] }}</h3>
                                        </div>

                                        <p class="quote-item-description">{{ $item['description'] }}</p>

                                        <div class="quote-meta">
                                            <span class="quote-complexity quote-complexity-{{ strtolower($item['complexity']) }}">Complejidad: {{ $item['complexity'] }}</span>
                                        </div>

                                        <div class="quote-price-band">
                                            <span>Precio individual: {{ '$' . number_format($item['min'], 0, ',', '.') }} - {{ '$' . number_format($item['max'], 0, ',', '.') }}</span>
                                            <strong>Precio sugerido: {{ '$' . number_format($suggested, 0, ',', '.') }}</strong>
                                        </div>

                                        <p class="quote-reason">{{ $item['reason'] }}</p>
                                    </label>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </div>

            <aside class="quote-summary" aria-label="Resumen de cotizacion">
                <h2>Resumen de cotizacion</h2>
                <p class="quote-summary-note">Seleccionadas: <strong data-quote-selected-count>0</strong> funcionalidades.</p>

                <div class="quote-legend" aria-label="Significado de precios y complejidad">
                    <p><strong>Minimo:</strong> valor base del mercado para implementar lo esencial.</p>
                    <p><strong>Maximo:</strong> valor para una version mas completa o compleja.</p>
                    <p><strong>Promedio sugerido:</strong> referencia practica para planificar presupuesto.</p>
                    <p><strong>Complejidad:</strong> Basico, Medio o Avanzado segun dificultad tecnica.</p>
                </div>

                <div class="quote-summary-list" data-quote-summary-list>
                    <p class="quote-empty">Aun no seleccionas funcionalidades.</p>
                </div>

                <div class="quote-total-block">
                    <div class="quote-total-row">
                        <span>Minimo estimado</span>
                        <strong data-quote-total-min>$0</strong>
                    </div>
                    <div class="quote-total-row">
                        <span>Maximo estimado</span>
                        <strong data-quote-total-max>$0</strong>
                    </div>
                    <div class="quote-total-row quote-total-highlight">
                        <span>Promedio sugerido</span>
                        <strong data-quote-total-avg>$0</strong>
                    </div>
                </div>

                <div class="quote-factors">
                    <h3>Factores que suben precio</h3>
                    <ul data-quote-factor-list>
                        <li>Selecciona funcionalidades para ver factores de complejidad.</li>
                    </ul>
                </div>

                <button type="button" class="btn btn-primary" data-quote-send disabled>Enviar cotizacion (proximamente)</button>
            </aside>
        </div>
    </div>
</section>
@endsection