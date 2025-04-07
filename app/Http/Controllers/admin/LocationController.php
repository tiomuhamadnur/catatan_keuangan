<?php

namespace App\Http\Controllers\admin;

use App\DataTables\LocationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

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
        $rawData = $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'owner' => 'string|required',
            'price' => 'numeric|required|min:1',
        ]);

        $request->validate([
            'photo' => 'nullable|file|image',
        ]);

        $data = Location::updateOrCreate($rawData, $rawData);

        // Update photo jika ada
        if ($request->hasFile('photo')) {
            $photoPath = $this->imageUploadService->uploadPhoto(
                $request->file('photo'),
                'photo/attachment/', // Path untuk photo
                300,
            );

            // Hapus file lama
            if ($data->photo) {
                Storage::delete($data->photo);
            }

            // Update path photo di database
            $data->update(['photo' => $photoPath]);
        }

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
            'description' => 'string|required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'owner' => 'string|required',
            'price' => 'numeric|required|min:1',
        ]);

        $request->validate([
            'photo' => 'nullable|file|image',
        ]);

        $data->update($rawData);

        // Update photo jika ada
        if ($request->hasFile('photo')) {
            $photoPath = $this->imageUploadService->uploadPhoto(
                $request->file('photo'),
                'photo/attachment/', // Path untuk photo
                300,
            );

            // Hapus file lama
            if ($data->photo) {
                Storage::delete($data->photo);
            }

            // Update path photo di database
            $data->update(['photo' => $photoPath]);
        }

        return redirect()->route('location.index')->withNotify('Data berhasil diubah');
    }

    public function destroy(string $uuid)
    {
        $data = Location::where('uuid', $uuid)->firstOrFail();
        $data->delete();
        return redirect()->route('location.index')->withNotify('Data berhasil dihapus');
    }
}
