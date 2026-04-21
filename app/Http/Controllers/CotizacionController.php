<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CotizacionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $mensajeConfirmacion = 'Tu cotizacion fue enviada. Te contactaremos por telefono o correo para confirmar tu proyecto.';

        $data = $request->validate([
            'total_min' => ['required', 'integer', 'min:0'],
            'total_max' => ['required', 'integer', 'min:0'],
            'total_avg' => ['required', 'integer', 'min:0'],
            'items' => ['required', 'json'],
            'factores' => ['nullable', 'json'],
            'comentario' => ['nullable', 'string', 'max:1000'],
        ]);

        $items = json_decode($data['items'], true);
        $factores = json_decode($data['factores'] ?? '[]', true);

        if (!is_array($items) || count($items) === 0) {
            return back()->with('quote_error', 'Debes seleccionar al menos una funcionalidad.');
        }

        Cotizacion::query()->create([
            'user_id' => (int) $request->user()->id,
            'total_min' => (int) $data['total_min'],
            'total_max' => (int) $data['total_max'],
            'total_avg' => (int) $data['total_avg'],
            'items' => $items,
            'factores' => is_array($factores) ? $factores : [],
            'comentario' => $data['comentario'] ?? null,
            'mensaje_confirmacion' => $mensajeConfirmacion,
        ]);

        return redirect()
            ->route('cotiza.index')
            ->with('quote_status', 'Cotizacion enviada correctamente.')
            ->with('quote_confirmation_message', $mensajeConfirmacion)
            ->with('quote_open_modal', true);
    }

    public function index(Request $request): View
    {
        if (! $request->user() || ! $request->user()->isAdmin()) {
            abort(403);
        }

        $cotizaciones = Cotizacion::query()
            ->with('user')
            ->latest()
            ->paginate(12);

        return view('administracion', [
            'cotizaciones' => $cotizaciones,
        ]);
    }
}
