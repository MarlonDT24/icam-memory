<?php

namespace App\Http\Controllers;

use App\Models\GroupElectro;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupElectroRequest;
use Illuminate\Support\Facades\Storage;

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
}
