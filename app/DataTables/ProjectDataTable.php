<?php

namespace App\DataTables;

use App\Helpers\FormatRupiahHelper;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('#', function ($item) {
                $editRoute = route('project.update', $item->uuid);
                $deleteRoute = route('project.destroy', $item->uuid);
                $showRoute = route('project.show', $item->uuid);
                $actionButton = "<div class='dropdown'>
                            <button class='btn btn-tabler btn-icon' data-bs-toggle='dropdown' aria-label='Tabler'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-settings'>
                                    <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                                    <path d='M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z'/>
                                    <path d='M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0'/>
                                </svg>
                            </button>

                            <div class='dropdown-menu dropdown-menu-end'>
                                <a class='dropdown-item' href='{$showRoute}'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-eye'>
                                    <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                                    <path d='M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0' />
                                    <path d='M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6' />
                                    </svg>
                                    Show
                                </a>
                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#editModal' data-url='{$editRoute}' data-name='{$item->name}' data-description='{$item->description}' data-location_id='{$item->location_id}' data-status_id='{$item->status_id}' data-category_id='{$item->category_id}' data-modal='{$item->modal}' data-start_date='{$item->start_date}' data-end_date='{$item->end_date}' data-remark='{$item->remark}'>
                                    <svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 24 24'  fill='none'  stroke='currentColor'  stroke-width='2'  stroke-linecap='round'  stroke-linejoin='round'  class='icon icon-tabler icons-tabler-outline icon-tabler-pencil'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4' /><path d='M13.5 6.5l4 4' /></svg>
                                    Edit
                                </a>
                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#deleteModal' data-url='{$deleteRoute}'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-trash'>
                                    <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                                    <path d='M4 7l16 0' />
                                    <path d='M10 11l0 6' />
                                    <path d='M14 11l0 6' />
                                    <path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' />
                                    <path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' />
                                    </svg>
                                    Delete
                                </a>
                            </div>
                        </div>";

                return $actionButton;
            })
            ->addColumn('modal', function($item) {
                return FormatRupiahHelper::currency($item->modal);
            })
            ->addColumn('absorption', function($item) {
                return FormatRupiahHelper::currency($item->absorptions->sum('total'));
            })
            ->rawColumns(['#']);
    }

    public function query(Project $model): QueryBuilder
    {
        return $model->with([
            'location',
            'status',
            'category',
            ])->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('project-table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => secure_url(request()->path()), // ← ini pakai HTTPS
                'type' => 'GET',
            ])
            ->pageLength(10)
            ->lengthMenu([10, 50, 100, 250, 500, 1000])
            //->dom('Bfrtip')
            ->orderBy([1, 'asc'])
            ->selectStyleSingle()
            ->buttons([
                [
                    'extend' => 'excel',
                    'text' => 'Export to Excel',
                    'attr' => [
                        'id' => 'datatable-excel',
                        'style' => 'display: none;',
                    ],
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('#')->exportable(false)->printable(false)->width(60)->addClass('text-center'),
            Column::make('name')->title('Name'),
            Column::make('category.name')->title('Category'),
            Column::make('location.name')->title('Location'),
            Column::computed('modal')->title('Modal'),
            Column::computed('absorption')->title('Absorption'),
            Column::make('status.name')->title('Status'),
            Column::make('start_date')->title('Start Date'),
            Column::make('end_date')->title('End Date'),
            Column::make('remark')->title('Remark'),
        ];
    }

    protected function filename(): string
    {
        return 'Project_' . date('YmdHis');
    }
}
