<?php

namespace App\DataTables;

use App\Helpers\FormatRupiahHelper;
use App\Models\Absorption;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AbsorptionDataTable extends DataTable
{
    protected $project_id;

    public function with(array|string $key, mixed $value = null): static
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->{$k} = $v;
            }
        } else {
            $this->{$key} = $value;
        }

        return $this;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('#', function ($item) {
                $editRoute = route('absorption.update', $item->uuid);
                $deleteRoute = route('absorption.destroy', $item->uuid);
                $photoUrl = null;
                if ($item->photo) {
                    $photoUrl = asset('storage/' . $item->photo);
                }
                $actionButton = "<div class='dropdown'>
                            <button class='btn btn-tabler btn-icon' data-bs-toggle='dropdown' aria-label='Tabler'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-settings'>
                                    <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                                    <path d='M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z'/>
                                    <path d='M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0'/>
                                </svg>
                            </button>

                            <div class='dropdown-menu dropdown-menu-end'>
                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#editModal' data-url='{$editRoute}' data-photo_url='{$photoUrl}' data-name='{$item->name}' data-type='{$item->type}' data-price='{$item->price}' data-qty='{$item->qty}' data-date='{$item->date}' data-unit_id='{$item->unit_id}' data-remark='{$item->remark}'>
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
            ->addColumn('price', function ($item) {
                return FormatRupiahHelper::currency($item->price);
            })
            ->addColumn('total', function ($item) {
                return FormatRupiahHelper::currency($item->total);
            })
            ->addColumn('photo', function ($item) {
                if (!$item->photo) {
                    return '';
                }
                $photoUrl = asset('storage/' . $item->photo);
                return "<button data-bs-toggle='modal' data-bs-target='#photoModal' data-photo='{$photoUrl}' class='btn btn-success btn-icon'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-photo'>
                                <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                                <path d='M15 8h.01' />
                                <path d='M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z' />
                                <path d='M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5' />
                                <path d='M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3' />
                            </svg>
                        </button>";
            })
            ->rawColumns(['#', 'photo']);
    }

    public function query(Absorption $model): QueryBuilder
    {
        return $model
            ->with(['project', 'unit', 'project.location', 'project.status'])
            ->where('project_id', $this->project_id)
            ->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('absorption-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->pageLength(10)
            ->lengthMenu([10, 50, 100, 250, 500, 1000])
            //->dom('Bfrtip')
            ->orderBy([1, 'desc'])
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
        return [Column::computed('#')->exportable(false)->printable(false)->width(60)->addClass('text-center'), Column::make('date')->title('Date')->sortable(true), Column::make('name')->title('Item Name'), Column::computed('price')->title('Price'), Column::make('qty')->title('Qty'), Column::make('unit.code')->title('Unit'), Column::computed('total')->title('Total'), Column::make('type')->title('Type'), Column::make('remark')->title('Remark'), Column::computed('photo')->title('Photo')];
    }

    protected function filename(): string
    {
        return 'Absorption_' . date('YmdHis');
    }
}
