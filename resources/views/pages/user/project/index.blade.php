@extends('layout.base')

@section('title-head')
    <title>Project</title>
@endsection

@section('page-header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Data Project
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-sm-inline">
                            <div class='dropdown'>
                                <button class='btn btn-outline-secondary dropdown-toggle align-text-top'
                                    data-bs-toggle='dropdown'>
                                    Actions
                                </button>
                                <div class='dropdown-menu dropdown-menu-end'>
                                    <a class='dropdown-item' href='#'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-filter">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
                                        </svg>
                                        Filter
                                    </a>
                                    <a class='dropdown-item' href='#'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-arrow-right">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M9 15h6" />
                                            <path d="M12.5 17.5l2.5 -2.5l-2.5 -2.5" />
                                        </svg>
                                        Export
                                    </a>
                                    <a class='dropdown-item' href='#'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-arrow-left">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M15 15h-6" />
                                            <path d="M11.5 17.5l-2.5 -2.5l2.5 -2.5" />
                                        </svg>
                                        Import
                                    </a>
                                </div>
                            </div>
                        </span>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addModal"
                            class="btn btn-primary d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Add new
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table table-vcenter card-table'], true) }}
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Add Modal -->
    <div class="modal modal-blur fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title">Add New</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Location</label>
                            <select class="form-select" name="location_id" id="location_id" required>
                                <option value="" selected disabled>- select option -</option>
                                @foreach ($location as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - ({{ $item->description ?? 'N/A' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Input name"
                                autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="2" placeholder="input description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Category</label>
                            <select class="form-select" name="category_id" required>
                                <option value="" selected disabled>- select option -</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Modal (Rp)</label>
                            <input type="number" class="form-control" name="modal" placeholder="Input modal (Rp)"
                                autocomplete="off" required min="1">
                        </div>
                        <div class="mb-3 row">
                            <div class="mb-3 col-sm-6">
                                <label class="form-label required">Start Date</label>
                                <input type="date" class="form-control" name="start_date"
                                    placeholder="input start date" required>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label required">End Date</label>
                                <input type="date" class="form-control" name="end_date"
                                    placeholder="input end date" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select class="form-select" name="status_id" id="status_id" required>
                                <option value="" selected disabled>- select option -</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Remark</label>
                            <textarea class="form-control" name="remark" id="remark" rows="4" placeholder="input remark"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal modal-blur fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="editForm" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Location</label>
                            <select class="form-select" name="location_id" id="location_id_edit" required>
                                <option value="" selected disabled>- select option -</option>
                                @foreach ($location as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - ({{ $item->description ?? 'N/A' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Name</label>
                            <input type="text" class="form-control" name="name" id="name_edit" placeholder="Input name"
                                autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Description</label>
                            <textarea class="form-control" name="description" id="description_edit" rows="2" placeholder="input description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Category</label>
                            <select class="form-select" name="category_id" id="category_id_edit" required>
                                <option value="" selected disabled>- select option -</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Modal (Rp)</label>
                            <input type="number" class="form-control" name="modal" id="modal_edit" placeholder="Input modal (Rp.)"
                                autocomplete="off" required min="1">
                        </div>
                        <div class="mb-3 row">
                            <div class="mb-3 col-sm-6">
                                <label class="form-label required">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date_edit"
                                    placeholder="input start date" required>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label required">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date_edit"
                                    placeholder="input end date" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <select class="form-select" name="status_id" id="status_id_edit" required>
                                <option value="" selected disabled>- select option -</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Remark</label>
                            <textarea class="form-control" name="remark" id="remark_edit" rows="4" placeholder="input remark"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'
                                fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round'
                                stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-pencil'>
                                <path stroke='none' d='M0 0h24v24H0z' fill='none' />
                                <path d='M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4' />
                                <path d='M13.5 6.5l4 4' />
                            </svg>
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#editModal').on('show.bs.modal', function(e) {
                var url = $(e.relatedTarget).data('url');
                var location_id = $(e.relatedTarget).data('location_id');
                var name = $(e.relatedTarget).data('name');
                var description = $(e.relatedTarget).data('description');
                var modal = $(e.relatedTarget).data('modal');
                var start_date = $(e.relatedTarget).data('start_date');
                var end_date = $(e.relatedTarget).data('end_date');
                var status_id = $(e.relatedTarget).data('status_id');
                var category_id = $(e.relatedTarget).data('category_id');
                var remark = $(e.relatedTarget).data('remark');

                document.getElementById("editForm").action = url;
                $('#location_id_edit').val(location_id);
                $('#name_edit').val(name);
                $('#description_edit').val(description);
                $('#modal_edit').val(modal);
                $('#start_date_edit').val(start_date);
                $('#end_date_edit').val(end_date);
                $('#status_id_edit').val(status_id);
                $('#category_id_edit').val(category_id);
                $('#remark_edit').val(remark);
            });
        });
    </script>
@endsection
