<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\PciCalculatorService;
use Illuminate\Http\Request;

class PciController extends Controller
{
    public function index()
    {
        return view('pci.index');
    }

    public function calculateAjax(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|string|in:Av,Ah,B,C,D',
            'superficie' => 'required|numeric|min:1',
            'uso' => 'required|string|in:almacenamiento,producción',
            'nivel' => 'required|integer|min:1|max:8',
            'rasante' => 'nullable|string|in:rasante,sotano',
        ]);

        $service = new PciCalculatorService();
        $resultados = $service->calculateWithJustification($validated);

        return response()->json([
            'success' => true,
            'nombre' => $validated['nombre'],
            'resultado' => $resultados,
        ]);
    }
}
