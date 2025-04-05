<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Absorption;
use App\Models\Project;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsorptionController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rawData = $request->validate([
            'project_id' => 'required|numeric|min_digits:1',
            'type' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|numeric|min_digits:1',
            'qty' => 'required|numeric|min_digits:1',
            'unit_id' => 'required|numeric',
            'date' => 'required|date',
            'remark' => 'nullable|string',
        ]);

        $request->validate([
            'photo' => 'nullable|file|image',
        ]);

        $project = Project::findOrFail($request->project_id);

        $data = Absorption::updateOrCreate($rawData, $rawData);

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

        return redirect()->route('project.show', $project->uuid)->withNotify('Data berhasil ditambahkan');
    }

    public function show(string $uuid)
    {
        //
    }

    public function edit(string $uuid)
    {
        //
    }

    public function update(Request $request, string $uuid)
    {
        $rawData = $request->validate([
            'project_id' => 'required|numeric|min_digits:1',
            'type' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|numeric|min_digits:1',
            'qty' => 'required|numeric|min_digits:1',
            'unit_id' => 'required|numeric',
            'date' => 'required|date',
            'remark' => 'nullable|string',
        ]);

        $request->validate([
            'photo' => 'nullable|file|image',
        ]);

        $data = Absorption::where('uuid', $uuid)->firstOrFail();

        $data->update($rawData);

        // Update photo jika ada
        if ($request->hasFile('photo')) {
            $photoPath = $this->imageUploadService->uploadPhoto(
                $request->file('photo'),
                'photo/attachment/', // Path untuk photo
                300
            );

            // Hapus file lama
            if ($data->photo) {
                Storage::delete($data->photo);
            }

            // Update path photo di database
            $data->update(['photo' => $photoPath]);
        }

        return redirect()->route('project.show', $data->project->uuid)->withNotify('Data berhasil diubah');
    }

    public function destroy(string $uuid)
    {
        //
    }
}
