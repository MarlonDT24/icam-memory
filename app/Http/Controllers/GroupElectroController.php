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
        $groupElectro->budget_excel = $request->file('budget_excel')->store('excels', 'private');
        $groupElectro->holder = $request->input('holder');
        $groupElectro->address = $request->input('address');
        $groupElectro->cod_address = $request->input('cod_address');
        $groupElectro->cif = $request->input('cif');
        $groupElectro->name_agent = $request->input('name_agent');
        $groupElectro->nif = $request->input('nif');
        $groupElectro->location = $request->input('location');
        $groupElectro->cod_location = $request->input('cod_location');
        $groupElectro->name_location = $request->input('name_location');
        $groupElectro->build = $request->input('build');
        $groupElectro->kva = $request->input('kva');
        $groupElectro->kw = $request->input('kw');
        $groupElectro->tension_type = $request->input('tension_type');
        $groupElectro->type_clasi = $request->input('type_clasi');
        $groupElectro->mark = $request->input('mark');
        $groupElectro->model = $request->input('model');
        $groupElectro->voltage = $request->input('voltage');
        $groupElectro->air_entry = $request->input('air_entry');
        $groupElectro->air_flow = $request->input('air_flow');
        $groupElectro->w = $request->input('w');
        $groupElectro->factor = $request->input('factor');
          
    
        // En caso de que se suba la imagen
        if ($request->hasFile('cover')) {
            // Metodo para guardar varios archivos en el mismo lugar (en este caso en el /storage/public)
            $groupElectro->cover = $request->file('cover')->store('covers', 'public');
        }
        // En caso de que se suba la imagen del modelo
        if ($request->hasFile('image_model')) {
            // Metodo para guardar varios archivos en el mismo lugar (en este caso en el /storage/public)
            $groupElectro->image_model = $request->file('image_model')->store('imagemodels', 'public');
        }
        // En caso de que se suba la imagen de las dimensiones
        if ($request->hasFile('image_dimensions')) {
            // Metodo para guardar varios archivos en el mismo lugar (en este caso en el /storage/public)
            $groupElectro->image_dimensions = $request->file('image_dimensions')->store('imagedimensions', 'public');
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
        $groupElectro->budget_excel = $request->file('budget_excel')->store('excels', 'private');
        $groupElectro->holder = $request->input('holder');
        $groupElectro->address = $request->input('address');
        $groupElectro->cod_address = $request->input('cod_address');
        $groupElectro->cif = $request->input('cif');
        $groupElectro->name_agent = $request->input('name_agent');
        $groupElectro->nif = $request->input('nif');
        $groupElectro->location = $request->input('location');
        $groupElectro->cod_location = $request->input('cod_location');
        $groupElectro->name_location = $request->input('name_location');
        $groupElectro->build = $request->input('build');
        $groupElectro->kva = $request->input('kva');
        $groupElectro->kw = $request->input('kw');
        $groupElectro->tension_type = $request->input('tension_type');
        $groupElectro->type_clasi = $request->input('type_clasi');
        $groupElectro->mark = $request->input('mark');
        $groupElectro->model = $request->input('model');
        $groupElectro->voltage = $request->input('voltage');
        $groupElectro->air_entry = $request->input('air_entry');
        $groupElectro->air_flow = $request->input('air_flow');
        $groupElectro->w = $request->input('w');
        $groupElectro->factor = $request->input('factor');
        
        // En caso de que se suba la imagen
        if ($request->hasFile('cover')) {
            // Elimina la imagen anterior si existe
            if ($groupElectro->cover) {
                Storage::delete($groupElectro->cover);
            }
            // Metodo para guardar varios archivos en el mismo lugar (en este caso en el /storage/public)
            $groupElectro->cover = $request->file('cover')->store('covers', 'public');
        }

        // En caso de que se suba la imagen del modelo
        if ($request->hasFile('image_model')) {
            // Elimina la imagen anterior si existe
            if ($groupElectro->image_model) {
                Storage::delete($groupElectro->image_model);
            }
            // Metodo para guardar varios archivos en el mismo lugar (en este caso en el /storage/public)
            $groupElectro->image_model = $request->file('image_model')->store('imagemodels', 'public');
        }

        // En caso de que se suba la imagen de las dimensiones
        if ($request->hasFile('image_dimensions')) {
            // Elimina la imagen anterior si existe
            if ($groupElectro->image_dimensions) {
                Storage::delete($groupElectro->image_dimensions);
            }
            // Metodo para guardar varios archivos en el mismo lugar (en este caso en el /storage/public)
            $groupElectro->image_dimensions = $request->file('image_dimensions')->store('imagedimensions', 'public');
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
        if ($groupElectro->image_model) {
            Storage::delete($groupElectro->image_model);
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
            'u7' => floatval($sheet->getCell('U7')->getValue()),
            'z7' => floatval($sheet->getCell('Z7')->getValue()),
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
        $templateProcessor->setValue ('mark', $groupElectro->mark);
        $templateProcessor->setValue ('model', $groupElectro->model);
        $templateProcessor->setValue ('air_entry', $groupElectro->air_entry);
        $templateProcessor->setValue ('air_flow', $groupElectro->air_flow);

        // Datos del excel
        $templateProcessor->setValue('budget', number_format($datesExcel['budget'], 2, ',', '.'));

        $tensionText = $groupElectro->tension_type === '3F+N'
            ? 'trifásica, de 400 V entre fases y 230 V entre fase y neutro.'
            : 'de 230 V entre fase y neutro.';
        $templateProcessor->setValue('tension_type', $tensionText);

        
        //Terminar de hacer el tipo de clasificacion
        $tensionText = $groupElectro->type_clasi === 'mojado'
            ? 'trifásica, de 400 V entre fases y 230 V entre fase y neutro.'
            : 'de 230 V entre fase y neutro.';
        $templateProcessor->setValue('type_clasi', $tensionText);

        $tensionService = $groupElectro->voltage === '3F+N'
            ? '400/230V'
            : '230V';
        $templateProcessor->setValue('voltage', $tensionService);

        //Imagenes
        if ($groupElectro->cover) {
            $imagePath = storage_path('app/public/'. $groupElectro->cover);
            if (file_exists($imagePath)) {
                $templateProcessor->setImageValue('cover', [
                    'path' => $imagePath,
                    'widht' => 150,
                    'heigh' => 150,
                    'ratio' => true,
                ]);
            }
        }
        if ($groupElectro->image_model) {
            $imagePath = storage_path('app/public/'. $groupElectro->image_model);
            if (file_exists($imagePath)) {
                $templateProcessor->setImageValue('image_model', [
                    'path' => $imagePath,
                    'widht' => 400,
                    'heigh' => 267,
                    'ratio' => false,
                ]);
            }
        }
        if ($groupElectro->image_dimensions) {
            $imagePath = storage_path('app/public/'. $groupElectro->image_dimensions);
            if (file_exists($imagePath)) {
                $templateProcessor->setImageValue('image_dimensions', [
                    'path' => $imagePath,
                    'widht' => 184,
                    'heigh' => 129,
                    'ratio' => false,
                ]);
            }
        }

        $templateProcessor->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
