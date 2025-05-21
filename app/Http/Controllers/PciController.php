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

    public function calculate(Request $request)
    {
        $validated = $request->validate([
        'tipo' => 'required|string',
        'superficie' => 'required|numeric|min:1',
        'uso' => 'required|string|in:almacenamiento,producción',
        'nivel' => 'required|integer|min:1|max:8',
        'rasante' => 'nullable|string|in:rasante,sotano',
    ]);

    $service = new PciCalculatorService();
    $resultados = $service->calculateWithJustification($validated);

    return view('pci.index', compact('resultados'));
    }
}
