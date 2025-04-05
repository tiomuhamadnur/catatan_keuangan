<?php

namespace App\Http\Controllers\admin;

use App\DataTables\LocationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(LocationDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.location.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'description' => 'string|required'
        ]);

        Location::updateOrCreate($data, $data);

        return redirect()->route('location.index')->withNotify('Data berhasil ditambahkan');
    }
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $uuid)
    {
        $data = Location::where('uuid', $uuid)->firstOrFail();
        $rawData = $request->validate([
            'name' => 'string|required',
            'description' => 'string|required'
        ]);

        $data->update($rawData);
        return redirect()->route('location.index')->withNotify('Data berhasil diubah');
    }

    public function destroy(string $uuid)
    {
        $data = Location::where('uuid', $uuid)->firstOrFail();
        $data->delete();
        return redirect()->route('location.index')->withNotify('Data berhasil dihapus');
    }
}
