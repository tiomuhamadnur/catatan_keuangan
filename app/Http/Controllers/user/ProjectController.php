<?php

namespace App\Http\Controllers\user;

use App\DataTables\AbsorptionDataTable;
use App\DataTables\ProjectDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use App\Models\Project;
use App\Models\Status;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(ProjectDataTable $dataTable)
    {
        $location = Location::all();
        $status = Status::all();
        $category = Category::all();

        return $dataTable->render('pages.user.project.index', compact([
            'location',
            'status',
            'category',
        ]));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "location_id" => "required|numeric",
            "name" => "required|string",
            "description" => "required|string",
            "modal" => "required|numeric|min:1",
            "start_date" => "required|date",
            "end_date" => "required|date",
            "status_id" => "required|numeric",
            "category_id" => "required|numeric",
            "remark" => "nullable|string",
        ]);

        Project::updateOrCreate($data, $data);

        return redirect()->route('project.index')->withNotify('Data berhasil ditambahkan');
    }

    public function show(string $uuid, AbsorptionDataTable $dataTable)
    {
        $project = Project::where('uuid', $uuid)->firstOrFail();
        $unit = Unit::orderBy('code', 'ASC')->get();

        return $dataTable->with([
            'project_id' => $project->id,
        ])->render('pages.user.absorption.index', compact([
            'project',
            'unit',
        ]));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $uuid)
    {
        $data = Project::where('uuid', $uuid)->firstOrFail();
        $rawData = $request->validate([
            "location_id" => "required|numeric",
            "name" => "required|string",
            "description" => "required|string",
            "modal" => "required|numeric|min:1",
            "start_date" => "required|date",
            "end_date" => "required|date",
            "status_id" => "required|numeric",
            "category_id" => "required|numeric",
            "remark" => "nullable|string",
        ]);

        $data->update($rawData);

        return redirect()->route('project.index')->withNotify('Data berhasil diubah');
    }

    public function destroy(string $uuid)
    {
        $data = Project::where('uuid', $uuid)->firstOrFail();
        $data->delete();
        return redirect()->route('project.index')->withNotify('Data berhasil dihapus');
    }
}
