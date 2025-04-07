<?php

namespace App\Http\Controllers;

use App\Models\GroupElectro;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupElectroRequest;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GroupElectroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form.groupElectro.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupElectroRequest $request)
    {
        $groupElectro = new GroupElectro();
        $groupElectro->name = $request->input('name');
        $groupElectro->budget_excel = $request->input('budget_excel');
        $groupElectro->holder = $request->input('holder');
        $groupElectro->address = $request->input('address');
        $groupElectro->cod_address = $request->input('cod_address');
        $groupElectro->cif = $request->input('cif');
        $groupElectro->name_agent = $request->input('name_agent');
        $groupElectro->nif = $request->input('nif');
        $groupElectro->location = $request->input('location');
        $groupElectro->cod_location = $request->input('cod_location');
        $groupElectro->name_location = $request->input('name_location');
          
    
        // En caso de que se suba la imagen
        if ($request->hasFile('cover')) {
            // Metodo para guardar varios archivos en el mismo lugar (en este caso en el /storage/public)
            $groupElectro->cover = $request->file('cover')->store('covers', 'public');
        }
        //Despues de cazar todos los datos del formulario se guarda
        $groupElectro->save();

        return redirect()->route('form.index', $groupElectro->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupElectro $groupElectro)
    {
        return view('form.groupElectro.show', compact('groupElectro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupElectro $groupElectro)
    {
        return view('form.groupElectro.edit', compact('groupElectro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupElectroRequest $request, GroupElectro $groupElectro)
    {
        $groupElectro->name = $request->input('name');
        $groupElectro->holder = $request->input('holder');
        $groupElectro->address = $request->input('address');
        $groupElectro->cod_address = $request->input('cod_address');
        $groupElectro->cif = $request->input('cif');
        $groupElectro->name_agent = $request->input('name_agent');
        $groupElectro->nif = $request->input('nif');
        $groupElectro->location = $request->input('location');
        $groupElectro->cod_location = $request->input('cod_location');
        $groupElectro->name_location = $request->input('name_location');
    
        // En caso de que se suba la imagen
        if ($request->hasFile('cover')) {
            // Metodo para guardar varios archivos en el mismo lugar (en este caso en el /storage/public)
            $groupElectro->cover = $request->file('cover')->store('covers', 'public');
        }
        // En caso de que se suba el excel
        if ($request->hasFile('budget_excel')) {
            $groupElectro->budget_excel = $request->file('budget_excel')->store('budgets', 'public');
        }

        //Despues de cazar todos los datos del formulario se guarda
        $groupElectro->save();

        return redirect()->route('form.index', $groupElectro->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupElectro $groupElectro)
    {
        if ($groupElectro->cover) {
            Storage::delete($groupElectro->cover);
        }
        $groupElectro->delete();
        return redirect()->route('form.index');
    }

    public function getExcelDate($file)
    {
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();

        return [
            'budget' => floatval($sheet->getCell('')->getValue()),
            // Seguir colocando los demas datos del excel
        ];

    }

    public function convertToWord(GroupElectro $groupElectro)
    {
        $templatePath = storage_path('app/private/plantillas/memoria_IEBT-modif-copia.doc');
        $outputPath = storage_path('app/public/' . $groupElectro->name . '.doc');

        $datesExcel = $this->getExcelDate(storage_path('app/private/excels'. $groupElectro->budget_excel));

        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('name', $groupElectro->name);
        $templateProcessor->setValue('holder', $groupElectro->holder);
        $templateProcessor->setValue('address', $groupElectro->address);
        $templateProcessor->setValue('cod_address', $groupElectro->cod_address);
        $templateProcessor->setValue('cif', $groupElectro->cif);
        $templateProcessor->setValue('name_agent', $groupElectro->name_agent);
        $templateProcessor->setValue('nif', $groupElectro->nif);
        $templateProcessor->setValue('location', $groupElectro->location);
        $templateProcessor->setValue('cod_location', $groupElectro->cod_location);
        $templateProcessor->setValue('name_location', $groupElectro->name_location);
        $templateProcessor->setValue('build', $groupElectro->build);
        $templateProcessor->setValue('kva', $groupElectro->kva);
        $templateProcessor->setValue('kw', $groupElectro->kw);

        $tensionText = $groupElectro->tension_type === '3F+N'
            ? 'La tensión será alterna trifásica, de 400 V entre fases y 230 V entre fase y neutro.'
            : 'La tensión será alterna, de 230 V entre fase y neutro.';
        $templateProcessor->setValue('tension_type', $tensionText);

        $presupuestoFormat = number_format($groupElectro->budget, 2, ',', '.');
        $templateProcessor->setValue('presupuesto_total', $presupuestoFormat);

        $templateProcessor->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
