@extends('layouts.app')

@section('content')
<section class="auth-page">
    <div class="container auth-shell {{ $authMode === 'register' ? 'register-mode' : '' }}" data-auth-shell data-auth-mode="{{ $authMode }}">
        <div class="auth-hero">
            @auth
                <p class="eyebrow">Cuenta Activa</p>
                <h1>Hola, {{ auth()->user()->name }}.</h1>
                <p>
                    Tu cuenta ya esta lista. Aqui tienes un resumen de tus datos personales registrados en GoriTech.
                </p>

                <div class="auth-profile-grid" aria-label="Datos personales del usuario">
                    <article class="auth-profile-item">
                        <h3>Nombre</h3>
                        <p>{{ auth()->user()->name }}</p>
                    </article>
                    <article class="auth-profile-item">
                        <h3>Correo</h3>
                        <p>{{ auth()->user()->email }}</p>
                    </article>
                    <article class="auth-profile-item">
                        <h3>Telefono</h3>
                        <p>{{ auth()->user()->telefono ?? 'No registrado' }}</p>
                    </article>
                    <article class="auth-profile-item">
                        <h3>Miembro desde</h3>
                        <p>{{ optional(auth()->user()->created_at)->format('d/m/Y') }}</p>
                    </article>
                </div>
            @endauth

            @guest
                <p class="eyebrow">Acceso GoriTech</p>
                <h1>Inicia sesion o registra tu cuenta en un solo lugar.</h1>
                <p>
                    Diseñamos este espacio para que el cambio entre iniciar sesion y registrarte sea fluido, claro y visualmente consistente con la marca.
                </p>

                <div class="auth-highlights">
                    <article>
                        <h3>Servicio personalizado</h3>
                        <p>Atencion cercana para cada cliente y cada necesidad.</p>
                    </article>
                    <article>
                        <h3>Diseño profesional</h3>
                        <p>Interfaz limpia, moderna y adaptada a la identidad de GoriTech.</p>
                    </article>
                    <article>
                        <h3>Lista para crecer</h3>
                        <p>Base preparada para sumar nuevas funciones sin rehacer el sistema.</p>
                    </article>
                </div>
            @endguest
        </div>

        <div class="auth-card">
            <div class="auth-status-bar">
                @if (session('status'))
                    @if (session('status_style') === 'created')
                        <div class="auth-flash auth-flash-created">
                            <p class="auth-flash-kicker">Registro exitoso</p>
                            <strong>Cuenta Creada!</strong>
                            <p>Tu cuenta ya esta activa. Bienvenido a la experiencia GoriTech.</p>
                        </div>
                    @else
                        <div class="auth-flash">{{ session('status') }}</div>
                    @endif
                @endif
                @error('email')
                    <div class="auth-flash auth-flash-error">{{ $message }}</div>
                @enderror
                @error('password')
                    <div class="auth-flash auth-flash-error">{{ $message }}</div>
                @enderror
                @error('password_confirmation')
                    <div class="auth-flash auth-flash-error">{{ $message }}</div>
                @enderror
                @error('name')
                    <div class="auth-flash auth-flash-error">{{ $message }}</div>
                @enderror
                @error('telefono')
                    <div class="auth-flash auth-flash-error">{{ $message }}</div>
                @enderror
            </div>

            @auth
                <div class="auth-logged">
                    <p class="eyebrow">Bienvenido, {{ auth()->user()->name }}</p>
                    <h2>Ya tienes una sesion activa.</h2>
                    <p>Desde aqui puedes cerrar sesion o volver al sitio principal.</p>
                    <div class="auth-actions">
                        <a class="btn btn-ghost" href="{{ url('/') }}">Volver al inicio</a>
                        <form action="{{ route('auth.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Cerrar sesion</button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <div class="auth-toggle" aria-label="Cambiar entre iniciar sesion y registrarse">
                    <button class="auth-toggle-btn {{ $authMode !== 'register' ? 'active' : '' }}" type="button" data-auth-switch="login">Iniciar sesion</button>
                    <button class="auth-toggle-btn {{ $authMode === 'register' ? 'active' : '' }}" type="button" data-auth-switch="register">Registrar</button>
                </div>

                <div class="auth-panels">
                    <form class="auth-form auth-login" action="{{ route('auth.login') }}" method="post" autocomplete="on">
                        @csrf
                        <div class="auth-form-header">
                            <p class="eyebrow">Iniciar sesion</p>
                            <h2>Accede a tu panel</h2>
                        </div>

                        <label for="login-email">Correo</label>
                        <input id="login-email" name="email" type="email" value="{{ old('email') }}" placeholder="tu@email.com" required>

                        <label for="login-password">Contraseña</label>
                        <input id="login-password" name="password" type="password" placeholder="Tu contraseña" required>

                        <label class="auth-check">
                            <input type="checkbox" name="remember" value="1">
                            <span>Recordarme en este equipo</span>
                        </label>

                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>

                    <form class="auth-form auth-register" action="{{ route('auth.register') }}" method="post" autocomplete="on">
                        @csrf
                        <div class="auth-form-header">
                            <p class="eyebrow">Registrar</p>
                            <h2>Crea tu cuenta</h2>
                        </div>

                        <label for="register-name">Nombre</label>
                        <input id="register-name" name="name" type="text" value="{{ old('name') }}" placeholder="Tu nombre" required>

                        <label for="register-email">Correo</label>
                        <input id="register-email" name="email" type="email" value="{{ old('email') }}" placeholder="tu@email.com" required>

                        <label for="register-telefono">Telefono</label>
                        <input id="register-telefono" name="telefono" type="tel" value="{{ old('telefono') }}" placeholder="56912345678" inputmode="numeric" pattern="[0-9]{8,15}" maxlength="15" required>

                        <label for="register-password">Contraseña</label>
                        <input id="register-password" name="password" type="password" placeholder="Crea una contraseña" required>

                        <label for="register-password-confirmation">Confirmar contraseña</label>
                        <input id="register-password-confirmation" name="password_confirmation" type="password" placeholder="Repite la contraseña" required>

                        <button type="submit" class="btn btn-primary">Crear cuenta</button>
                    </form>
                </div>
            @endguest
        </div>
    </div>
</section>
@endsection
