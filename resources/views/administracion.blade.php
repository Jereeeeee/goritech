@extends('layouts.app')

@section('content')
<section class="admin-page" data-admin-page>
    <div class="container admin-shell">
        <div class="admin-head">
            <p class="section-tag">Administracion</p>
            <h1>Cotizaciones recibidas</h1>
            <p>Panel interno para revisar las solicitudes de cotizacion enviadas por los usuarios.</p>
        </div>

        <div class="admin-metrics">
            <article class="admin-metric">
                <p>Total de cotizaciones</p>
                <strong>{{ $cotizaciones->total() }}</strong>
            </article>
            <article class="admin-metric">
                <p>Pagina actual</p>
                <strong>{{ $cotizaciones->currentPage() }}</strong>
            </article>
        </div>

        <div class="admin-list">
            @forelse ($cotizaciones as $cotizacion)
                @php
                    $payload = [
                        'id' => $cotizacion->id,
                        'fecha' => optional($cotizacion->created_at)->format('d/m/Y H:i'),
                        'cliente' => $cotizacion->user->name ?? 'Sin nombre',
                        'correo' => $cotizacion->user->email ?? 'Sin correo',
                        'telefono' => $cotizacion->user->telefono ?? 'Sin telefono',
                        'minimo' => (int) $cotizacion->total_min,
                        'maximo' => (int) $cotizacion->total_max,
                        'promedio' => (int) $cotizacion->total_avg,
                        'items' => $cotizacion->items ?? [],
                        'factores' => $cotizacion->factores ?? [],
                        'comentario' => $cotizacion->comentario,
                        'mensajeConfirmacion' => $cotizacion->mensaje_confirmacion,
                    ];
                @endphp
                <article class="admin-card" data-admin-card>
                    <div class="admin-card-head">
                        <h2>Cotizacion #{{ $cotizacion->id }}</h2>
                        <span>{{ optional($cotizacion->created_at)->format('d/m/Y H:i') }}</span>
                    </div>

                    <div class="admin-user">
                        <p><strong>Cliente:</strong> {{ $cotizacion->user->name ?? 'Sin nombre' }}</p>
                        <p><strong>Correo:</strong> {{ $cotizacion->user->email ?? 'Sin correo' }}</p>
                        <p><strong>Telefono:</strong> {{ $cotizacion->user->telefono ?? 'Sin telefono' }}</p>
                    </div>

                    <div class="admin-card-actions">
                        <button type="button" class="btn btn-primary" data-admin-open>Ver cotizacion completa</button>
                    </div>

                    <script type="application/json" data-admin-payload>@json($payload)</script>
                </article>
            @empty
                <div class="admin-empty">
                    Aun no hay cotizaciones registradas.
                </div>
            @endforelse
        </div>

        @if ($cotizaciones->hasPages())
            <div class="admin-pagination">
                {{ $cotizaciones->links() }}
            </div>
        @endif

        <div class="admin-modal" data-admin-modal aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="admin-modal-title">
            <div class="admin-modal-backdrop" data-admin-close></div>
            <div class="admin-modal-panel">
                <div class="admin-modal-head">
                    <h2 id="admin-modal-title">Cotizacion <span data-admin-modal-id>#-</span></h2>
                    <button type="button" class="admin-modal-close" data-admin-close aria-label="Cerrar modal">×</button>
                </div>

                <p class="admin-modal-date" data-admin-modal-fecha></p>

                <div class="admin-modal-grid">
                    <section>
                        <h3>Cliente</h3>
                        <p><strong>Nombre:</strong> <span data-admin-modal-cliente></span></p>
                        <p><strong>Correo:</strong> <span data-admin-modal-correo></span></p>
                        <p><strong>Telefono:</strong> <span data-admin-modal-telefono></span></p>
                    </section>

                    <section>
                        <h3>Totales</h3>
                        <p><strong>Minimo:</strong> <span data-admin-modal-minimo></span></p>
                        <p><strong>Maximo:</strong> <span data-admin-modal-maximo></span></p>
                        <p><strong>Promedio:</strong> <span data-admin-modal-promedio></span></p>
                    </section>
                </div>

                <section class="admin-modal-section">
                    <h3>Items seleccionados</h3>
                    <ul data-admin-modal-items></ul>
                </section>

                <section class="admin-modal-section admin-modal-accordion">
                    <button type="button" class="admin-accordion-toggle" data-admin-factors-toggle aria-expanded="false">
                        <span>Factores de complejidad</span>
                        <span class="admin-accordion-icon" aria-hidden="true">+</span>
                    </button>
                    <div class="admin-accordion-content" data-admin-factors-content hidden>
                        <ul data-admin-modal-factores></ul>
                    </div>
                </section>

                <section class="admin-modal-section">
                    <h3>Comentario del cliente</h3>
                    <p data-admin-modal-comentario>Sin comentario registrado.</p>
                </section>

                <section class="admin-modal-section">
                    <h3>Mensaje mostrado al cliente</h3>
                    <p data-admin-modal-mensaje>Sin mensaje registrado.</p>
                </section>
            </div>
        </div>
    </div>
</section>
@endsection
