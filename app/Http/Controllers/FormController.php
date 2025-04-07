<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FormularioRequest;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::orderBy('created_at', 'DESC')->get();  //Las memorias se ordenan por fecha de creación
        return view('form.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form.compatibility.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormularioRequest $request)
    {
        $form = new Form();
        $form->name = $request->input('name');
        $form->holder = $request->input('holder');
        $form->address = $request->input('address');
        $form->cod_address = $request->input('cod_address');
        $form->cif = $request->input('cif');
        $form->name_agent = $request->input('name_agent');
        $form->nif = $request->input('nif');
        $form->location = $request->input('location');
        $form->cod_location = $request->input('cod_location');
        $form->activity = $request->input('activity');
        $form->description = $request->input('description');
        $form->m_parcels = $request->input('m_parcels');
        $form->m_surface = $request->input('m_surface');
        $form->requirements = "La instalación requiere de los servicios básicos de cualquier nave industrial. Estos servicios son los siguientes:\n\n• Conexión con red de agua municipal.\n• Conexión con red de alcantarillado.\n• Servicio de recogida de basuras.\n\nTambién se requiere conexión con la red eléctrica de Baja Tensión, aunque este servicio depende de la Compañía Suministradora.";

        // En caso de que se suba la imagen
        if ($request->hasFile('cover')) {
            // Metodo para guardar varios archivos en el mismo lugar (en este caso en el /storage/public)
            $form->cover = $request->file('cover')->store('covers', 'public');
        }
        //Despues de cazar todos los datos del formulario se guarda
        $form->save();

        return redirect()->route('form.index', $form->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        return view('form.compatibility.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        return view('form.compatibility.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormularioRequest $request, Form $form)
    {
        $form->name = $request->input('name');
        $form->holder = $request->input('holder');
        $form->address = $request->input('address');
        $form->cod_address = $request->input('cod_address');
        $form->cif = $request->input('cif');
        $form->name_agent = $request->input('name_agent');
        $form->nif = $request->input('nif');
        $form->location = $request->input('location');
        $form->cod_location = $request->input('cod_location');
        $form->activity = $request->input('activity');
        $form->description = $request->input('description');
        $form->m_parcels = $request->input('m_parcels');
        $form->m_surface = $request->input('m_surface');
        $form->requirements = "La instalación requiere de los servicios básicos de cualquier nave industrial. Estos servicios son los siguientes:\n\n• Conexión con red de agua municipal.\n• Conexión con red de alcantarillado.\n• Servicio de recogida de basuras.\n\nTambién se requiere conexión con la red eléctrica de Baja Tensión, aunque este servicio depende de la Compañía Suministradora.";

        // En caso de que se actualize la imagen
        if ($request->hasFile('cover')) {
            // Elimina la imagen anterior si existe
            if ($form->cover) {
                Storage::delete($form->cover);
            }
            // Metodo para guardar varios archivos en el mismo lugar (en este caso en el /storage/public)
            $form->cover = $request->file('cover')->store('covers', 'public');
        }
        //Despues de cazar todos los datos del formulario se guarda
        $form->save();

        return redirect()->route('form.index', $form->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        if ($form->cover) {
            Storage::delete($form->cover);
        }
        $form->delete();
        return redirect()->route('form.index');
    }

    // Función para crear la plantilla de Word
    public function convertToWord(Form $form)
    {
        $phpWord = new PhpWord();

        // Márgenes personalizados
        $section = $phpWord->addSection([
            'marginLeft'   => 1750,   // ≈ 1.7 cm
            'marginRight'  => 1750,
            'marginTop'    => 1300,
            'marginBottom' => 1300,
        ]);

        // Estilos de párrafo
        $phpWord->addParagraphStyle('centered', ['alignment' => 'center']);
        $phpWord->addParagraphStyle('leftIndented', [
            'alignment' => 'left',
            'indentation' => ['left' => 1200], // Sangría para centrar visualmente
            'spacing' => 85                   // Interlineado de 1.5
        ]);
        $phpWord->addParagraphStyle('textSpacing', [
            'spacing' => 85
        ]);
        //$phpWord->addParagraphStyle('rightAligned', ['alignment' => 'right']);

        // Estilos de fuente
        $titleStyle    = ['name' => 'Leelawadee', 'bold' => true, 'size' => 12, 'underline' => 'single'];
        $subtitleStyle = ['name' => 'Leelawadee', 'bold' => true, 'size' => 12];
        $textStyle     = ['name' => 'Leelawadee', 'size' => 12];

        // MEMORIA DESCRIPTIVA (centrado)
        $section->addText("MEMORIA DESCRIPTIVA", $titleStyle, 'centered');
        $section->addTextBreak(1);

        // TITULAR (texto a la izquierda + imagen a la derecha)
        $section->addText("Titular:", $subtitleStyle);
        $table = $section->addTable();
        $table->addRow();

        // "cell1" se usa para juntar todo en 1 sola celda para el contenido de "TITULAR"
        $cell1 = $table->addCell(7000); // Texto
        $cell1->addText(strip_tags($form->holder), $textStyle, 'leftIndented');
        $cell1->addText(strip_tags($form->address), $textStyle, 'leftIndented');
        $cell1->addText(strip_tags($form->cod_address), $textStyle, 'leftIndented');
        $cell1->addText("C.I.F: " . strip_tags($form->cif), $textStyle, 'leftIndented');

        $cell1->addTextBreak(1);
        $cell1->addText("Representante:", $textStyle, 'leftIndented');
        $cell1->addText(strip_tags($form->name_agent), $textStyle, 'leftIndented');
        $cell1->addText("N.I.F: " . strip_tags($form->nif), $textStyle, 'leftIndented');

        // "cell2" se usa para colocar la imagen a la derecha del contenido de "TITULAR"
        $cell2 = $table->addCell(3000); // Imagen
        if ($form->cover) {
            $imagePath = storage_path("app/public/" . $form->cover);
            if (file_exists($imagePath)) {
                $cell2->addImage($imagePath, [
                    'width' => 150,
                    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT
                ]);
            }
        }

        $section->addTextBreak(1);

        // EMPLAZAMIENTO
        $section->addText("Emplazamiento:", $subtitleStyle);
        $section->addText(strip_tags($form->location), $textStyle, 'leftIndented');
        $section->addText(strip_tags($form->cod_location), $textStyle, 'leftIndented');
        $section->addTextBreak(1);

        // ACTIVIDAD
        $section->addText("Actividad:", $subtitleStyle);
        $textRun = $section->addTextRun('textSpacing');
        $textRun->addText("El local objeto presente proyecto se destina a la actividad de ", $textStyle);
        $textRun->addText(mb_strtoupper(strip_tags($form->activity), 'UTF-8'), ['name' => 'Leelawadee', 'size' => 12, 'bold' => true]);
        $section->addTextBreak(1);

        // Descripcion respetando los saltos de linea
        $descriptionLines = preg_split("/\r\n|\n|\r/", strip_tags($form->description));
        foreach ($descriptionLines as $line) {
            $section->addText(trim($line), $textStyle, 'textSpacing');
        }
        //Salto de página
        $section->addPageBreak();

        // NECESIDADES DE USO Y APROVECHAMIENTO DEL SUELO
        $section->addText("NECESIDADES DE USO Y APROVECHAMIENTO DEL SUELO:", $titleStyle, 'centered');
        $section->addText("La actividad se desarrolla en SUELO URBANO, ZONA INDUSTRIAL; en el que se permite el desarrollo de este tipo de actividad, por lo tanto, no creemos que haya mayor problema en realizar la actividad en esta ubicación.", $textStyle, 'textSpacing');
        $section->addTextBreak(1);
        // Formato metros cuadrados
        $mParcels = rtrim(rtrim(number_format($form->m_parcels, 2, '.', ''), '0'), '.');
        $mSurface = rtrim(rtrim(number_format($form->m_surface, 2, '.', ''), '0'), '.');
        $section->addText("La actividad se ubicará en una nave industrial habilitada para la realización de la presente actividad, edificada sobre una parcela de $mParcels m2 de superficie, de forma predominante rectangular, y construida por encima de la rasante. La superficie edificada es de $mSurface m2 aproximadamente.", $textStyle, 'textSpacing');
        //Salto de página
        $section->addPageBreak();

        // REQUERIMIENTOS DE LA INSTALACIÓN
        $section->addText("REQUERIMIENTOS DE LA INSTALACIÓN RESPECTO A LOS SERVICIOS PÚBLICOS MUNICIPALES:", $titleStyle, 'centered');
        $requirementsLines = preg_split("/\r\n|\n|\r/", strip_tags($form->requirements));
        foreach ($requirementsLines as $line) {
            $section->addText(trim($line), $textStyle, 'textSpacing');
        }

        // FOOTER: pie de página alineado a la derecha y en español
        $footer = $section->addFooter();

        setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain', 'Spanish');
        $fechaEspañol = ucfirst(strftime('%d de %B de %Y'));
        $footer->addText("Valencia, " . $fechaEspañol, ['italic' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT]);

        // Guardamos el archivo
        $fileName = 'URB-' . $form->name . '.docx';
        $path = storage_path('app/public/' . $fileName);
        $wordWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $wordWriter->save($path);

        return response()->download($path)->deleteFileAfterSend(true);
    }

}
