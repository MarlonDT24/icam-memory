<?php

namespace App\Http\Controllers;

use App\Models\GroupElectro;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupElectroRequest;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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
        $groupElectro->author = $request->input('author');
        $groupElectro->budget_excel = $request->file('budget_excel')->store('excels', 'private'); //Se define donde se va a guardar
        if ($request->hasFile('budget_excel')) {
            $tempPath = $request->file('budget_excel')->store('temp');
            session()->flash('temp_budget_excel', $tempPath);
        }
        //dd($path); 
        $groupElectro->holder = $request->input('holder');
        $groupElectro->address = $request->input('address');
        $groupElectro->cod_address = $request->input('cod_address');
        $groupElectro->local_address = $request->input('local_address');
        $groupElectro->town_address = $request->input('town_address');
        $groupElectro->cif = $request->input('cif');
        $groupElectro->name_agent = $request->input('name_agent');
        $groupElectro->nif = $request->input('nif');
        $groupElectro->location = $request->input('location');
        $groupElectro->cod_location = $request->input('cod_location');
        $groupElectro->name_location = $request->input('name_location');
        $groupElectro->name_town = $request->input('name_town');
        $groupElectro->build = $request->input('build');
        $groupElectro->kva = $request->input('kva');
        $groupElectro->kw = $request->input('kw');
        $groupElectro->tension_type = $request->input('tension_type');
        $groupElectro->budget = $request->input('budget');
        $groupElectro->type_clasi = $request->input('type_clasi');
        $groupElectro->mark = $request->input('mark');
        $groupElectro->model = $request->input('model');
        $groupElectro->voltage = $request->input('voltage');
        $groupElectro->air_entry = $request->input('air_entry');
        $groupElectro->air_flow = $request->input('air_flow');
        $groupElectro->w = $request->input('w');
        $groupElectro->factor = $request->input('factor');
        $groupElectro->method = $request->input('method');


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
        $groupElectro->author = $request->input('author');
        $groupElectro->budget_excel = $request->file('budget_excel')->store('excels', 'private');
        $groupElectro->holder = $request->input('holder');
        $groupElectro->address = $request->input('address');
        $groupElectro->cod_address = $request->input('cod_address');
        $groupElectro->local_address = $request->input('local_address');
        $groupElectro->town_address = $request->input('town_address');
        $groupElectro->cif = $request->input('cif');
        $groupElectro->name_agent = $request->input('name_agent');
        $groupElectro->nif = $request->input('nif');
        $groupElectro->location = $request->input('location');
        $groupElectro->cod_location = $request->input('cod_location');
        $groupElectro->name_location = $request->input('name_location');
        $groupElectro->name_town = $request->input('name_town');
        $groupElectro->build = $request->input('build');
        $groupElectro->kva = $request->input('kva');
        $groupElectro->kw = $request->input('kw');
        $groupElectro->tension_type = $request->input('tension_type');
        $groupElectro->budget = $request->input('budget');
        $groupElectro->type_clasi = $request->input('type_clasi');
        $groupElectro->mark = $request->input('mark');
        $groupElectro->model = $request->input('model');
        $groupElectro->voltage = $request->input('voltage');
        $groupElectro->air_entry = $request->input('air_entry');
        $groupElectro->air_flow = $request->input('air_flow');
        $groupElectro->w = $request->input('w');
        $groupElectro->factor = $request->input('factor');
        $groupElectro->method = $request->input('method');

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

    public function geoLookup(Request $request)
    {
        $postal = $request->input('postalcode');
        $url = "http://api.geonames.org/postalCodeLookupJSON?postalcode={$postal}&country=ES&username=marlon24";

        $response = Http::get($url);

        return response()->json($response->json());
    }


    public function getExcelDate($file)
    {
        if (!file_exists($file)) {
            throw new \Exception("El archivo no existe: $file");
        }

        try {
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getSheetByName('CUADRO GENERAL');
        } catch (\Throwable $e) {
            throw new \Exception("Error al leer el archivo Excel: " . $e->getMessage());
        }

        $cells = [];
        $letters = ['C', 'U', 'Z'];
        $rows = range(7, 12);

        foreach ($letters as $col) {
            foreach ($rows as $row) {
                $key = strtolower($col . $row);
                $cells[$key] = $sheet->getCell("$col$row")->getFormattedValue();
            }
        }

        return $cells;
    }

    public function convertToWord(GroupElectro $groupElectro)
    {
        $templatePath = storage_path('app/private/plantillas/memoria_IEBT-GE_2032-modif-copia.docx');
        $outputPath = storage_path('app/public/' . $groupElectro->name . '.doc');

        // Ya contiene la ruta relativa puesta ya en store() y ademas ya esta configurado en config/filesystems.php
        $excelPath = Storage::disk('private')->path($groupElectro->budget_excel);
        $datesExcel = $this->getExcelDate($excelPath);

        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('name', $groupElectro->name);
        $templateProcessor->setValue('holder', $groupElectro->holder);
        $templateProcessor->setValue('address', $groupElectro->address);
        $templateProcessor->setValue('cod_address', $groupElectro->cod_address);
        $templateProcessor->setValue('local_address', $groupElectro->local_address);
        $templateProcessor->setValue('town_address', $groupElectro->town_address);
        $templateProcessor->setValue('cif', $groupElectro->cif);
        $templateProcessor->setValue('name_agent', $groupElectro->name_agent);
        $templateProcessor->setValue('nif', $groupElectro->nif);
        $templateProcessor->setValue('location', $groupElectro->location);
        $templateProcessor->setValue('cod_location', $groupElectro->cod_location);
        $templateProcessor->setValue('name_location', $groupElectro->name_location);
        $templateProcessor->setValue('name_town', $groupElectro->name_town);
        $templateProcessor->setValue('build', $groupElectro->build);
        $templateProcessor->setValue('kva', $groupElectro->kva);
        $templateProcessor->setValue('kw', $groupElectro->kw);
        $templateProcessor->setValue('budget', $groupElectro->budget);
        $templateProcessor->setValue('mark', $groupElectro->mark);
        $templateProcessor->setValue('model', $groupElectro->model);
        $templateProcessor->setValue('air_entry', $groupElectro->air_entry);
        $templateProcessor->setValue('air_flow', $groupElectro->air_flow);
        $templateProcessor->setValue('method', $groupElectro->method);

        // Datos del excel
        foreach ($datesExcel as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }

        $authors = [
            'luis_m' => 'ICLM',
            'enrique_s' => 'ICES',
            'jaime_c' => 'ICJC',
            'marta_n' => 'ICMN',
            'pepe_a' => 'ICPA',
            'oscar_a' => 'ICOA',
        ];

        $authorText = $authors[$groupElectro->author] ?? 'Autor no especificado';
        $templateProcessor->setValue('author', $authorText);

        $typeClasiText = match ($groupElectro->type_clasi) {
            'mojado' => 'mojada ya que se trata de una instalación a la intemperie',
            'humedo' => 'húmeda ya que se encuentra en una zona con presencia de humedad',
            'ambos' => 'mojada ya que se trata de una instalación a la intemperie y húmeda ya que se encuentra en una zona con presencia de humedad',
            'noclasi' => 'no clasificada',
            default => 'no clasificada',
        };

        $templateProcessor->setValue('type_clasi', $typeClasiText);


        //Terminar de hacer el tipo de tensio
        $tensionText = match ($groupElectro->tension_type) {
            '3F+N' => 'trifásica, de 400 V entre fases y 230 V entre fase y neutro.',
            'F+N' => 'de 230 V entre fase y neutro.'
        };
        $templateProcessor->setValue('tension_type', $tensionText);

        //Tenseión de servicio
        $tensionService = $groupElectro->voltage === '3F+N'
            ? '400/230V'
            : '230V';
        $templateProcessor->setValue('voltage', $tensionService);

        //Imagenes
        if ($groupElectro->cover) {
            $imagePath = storage_path('app/public/' . $groupElectro->cover);
            if (file_exists($imagePath)) {
                $templateProcessor->setImageValue('cover', [
                    'path' => $imagePath,
                    'width' => 150,
                    'height' => 150,
                    'ratio' => true,
                ]);
            }
        }
        if ($groupElectro->image_model) {
            $imagePath = storage_path('app/public/' . $groupElectro->image_model);
            if (file_exists($imagePath)) {
                $templateProcessor->setImageValue('image_model', [
                    'path' => $imagePath,
                    'width' => 440,
                    'height' => 270,
                    'ratio' => false,
                ]);
            }
        }
        if ($groupElectro->image_dimensions) {
            $imagePath = storage_path('app/public/' . $groupElectro->image_dimensions);
            if (file_exists($imagePath)) {
                $templateProcessor->setImageValue('image_dimensions', [
                    'path' => $imagePath,
                    'width' => 160,
                    'height' => 110,
                    'ratio' => false,
                ]);
            }
        }

        //Calculo de Potencia Instalada en KW
        $poten = floatval($groupElectro->w);
        $factorP = floatval($groupElectro->factor);
        $voltaje = 400;
        $intensidad = $poten / ($voltaje * sqrt(3) * $factorP);
        //Le damos un formato al resultado de la I
        $format = number_format($intensidad, 2, ',', '.'); // Ej: 87,78
        $templateProcessor->setValue('w', $groupElectro->w);
        $templateProcessor->setValue('factor', $groupElectro->factor);
        $templateProcessor->setValue('resul', $format);

        //Fecha actual para el documento
        $meses = [1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $mes = $meses[date('n')];
        $anyo = date('Y');
        $formatdate = ucfirst($mes) . ' de ' . $anyo;
        $templateProcessor->setValue('fecha', $formatdate);

        $templateProcessor->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
