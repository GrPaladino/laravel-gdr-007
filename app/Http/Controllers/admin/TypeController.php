<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreTypeRequest $request)
    {
        $request->validated();

        $data = $request->all();
        $type = new Type;
        $type->fill($data);
        $type->save();
        return redirect()->route('admin.types.show', compact('type'))->with('message-class', 'alert-success')->with('message', 'Tipo di personaggio inserito correttamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $request->validated();
        $data = $request->all();
        $type->update($data);
        return redirect()->route('admin.types.show', $type)->with('message-class', 'alert-success')->with('message', 'Tipo di personaggio modificato correttamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('message-class', 'alert-danger')->with('message', 'Tipo di personaggio eliminato correttamente.');
    }
}
