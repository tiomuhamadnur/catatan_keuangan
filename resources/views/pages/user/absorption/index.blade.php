@extends('layout.base')

@section('title-head')
    <title>Absorption</title>
@endsection

@section('page-header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Project: {{ $project->name ?? 'N/A' }} - ({{ $project->location->name ?? 'N/A' }})
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
                                    <a class='dropdown-item' href='{{ route('project.index') }}'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l14 0" />
                                            <path d="M5 12l6 6" />
                                            <path d="M5 12l6 -6" />
                                        </svg>
                                        Back
                                    </a>
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
            <div class="mb-1">
                <table>
                    <tr>
                        <td class="fw-bolder">Modal</td>
                        <td>:</td>
                        <td>@currency($project->modal)</td>
                    </tr>
                    <tr>
                        <td class="fw-bolder">Pengeluaran</td>
                        <td>:</td>
                        <td>@currency($project->absorptions->where('type', 'pengeluaran')->sum('total'))</td>
                    </tr>
                    <tr>
                        <td class="fw-bolder">Pemasukan</td>
                        <td>:</td>
                        <td>@currency($project->absorptions->where('type', 'pemasukan')->sum('total'))</td>
                    </tr>
                    <tr>
                        @php
                        $sisa = $project->modal - $project->absorptions->sum('total');
                        @endphp
                        <td class="fw-bolder">Sisa</td>
                        <td>:</td>
                        <td class="fw-bolder @if($sisa <= 0) text-danger @else text-success @endif">@currency($sisa)</td>
                    </tr>
                </table>
            </div>
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
                <form action="{{ route('absorption.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title">Add New</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
                        <div class="mb-3">
                            <label class="form-label required">Project</label>
                            <input type="text" class="form-control" placeholder="Input project name"
                                autocomplete="off" required value="{{ $project->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Type</label>
                            <select class="form-select" name="type" id="type" required>
                                <option value="" selected disabled>- select option -</option>
                                <option value="pengeluaran">Pengeluaran</option>
                                <option value="pemasukan">Pemasukan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Date</label>
                            <input type="date" class="form-control" name="date" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Item Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Input name"
                                autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Price (Rp)</label>
                            <input type="number" class="form-control" name="price" placeholder="Input price (Rp)"
                                autocomplete="off" required min="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Qty.</label>
                            <input type="number" class="form-control" name="qty" placeholder="Input qty"
                                autocomplete="off" required min="0.01" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Unit</label>
                            <select class="form-select" name="unit_id" required>
                                <option value="" selected disabled>- select option -</option>
                                @foreach ($unit as $item)
                                    <option value="{{ $item->id }}">{{ $item->code }} ({{ $item->name }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <div class="text-left mb-2">
                                <img class="img-thumbnail" id="previewImage" src="#" alt="Tidak ada photo"
                                    style="max-width: 250px; max-height: 250px; display: none;">
                            </div>
                            <input type="file" class="form-control" name="photo" id="photo" accept="image/*">
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
                        <input type="hidden" name="project_id" id="project_id_edit" value="{{ $project->id }}">
                        <div class="mb-3">
                            <label class="form-label required">Project</label>
                            <input type="text" class="form-control" placeholder="Input project name"
                                autocomplete="off" required value="{{ $project->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Type</label>
                            <select class="form-select" name="type" id="type_edit" required>
                                <option value="" selected disabled>- select option -</option>
                                <option value="pengeluaran">Pengeluaran</option>
                                <option value="pemasukan">Pemasukan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Date</label>
                            <input type="date" class="form-control" name="date" id="date_edit" autocomplete="off"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Item Name</label>
                            <input type="text" class="form-control" name="name" id="name_edit"
                                placeholder="Input name" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Price (Rp)</label>
                            <input type="number" class="form-control" name="price" id="price_edit"
                                placeholder="Input price (Rp)" autocomplete="off" required min="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Qty.</label>
                            <input type="number" class="form-control" name="qty" id="qty_edit"
                                placeholder="Input qty" autocomplete="off" required min="0.01" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Unit</label>
                            <select class="form-select" name="unit_id" id="unit_id_edit" required>
                                <option value="" selected disabled>- select option -</option>
                                @foreach ($unit as $item)
                                    <option value="{{ $item->id }}">{{ $item->code }} ({{ $item->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <div class="mb-2 text-left">
                                <img class="img-thumbnail" id="previewImageEdit" src="#" alt="Tidak ada photo"
                                    style="max-width: 250px; max-height: 250px; display: none;">
                            </div>
                            <input type="file" class="form-control" name="photo" id="photo_edit" accept="image/*"
                                autocomplete="off">
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

    <!-- Photo Modal -->
    <div class="modal modal-blur fade" id="photoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="mb-4 text-center align-middle">
                            <div class="mx-auto">
                                <img src="#" id="photo_modal" class="img-thumbnail" alt="Tidak ada photo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Close
                    </a>
                </div>
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
            const imageInput = document.getElementById('photo');
            const previewImage = document.getElementById('previewImage');

            imageInput.addEventListener('change', function(event) {
                const selectedFile = event.target.files[0];

                if (selectedFile) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                    }

                    reader.readAsDataURL(selectedFile);
                }
            });

            const imageInputEdit = document.getElementById('photo_edit');
            const previewImageEdit = document.getElementById('previewImageEdit');

            imageInputEdit.addEventListener('change', function(event) {
                const selectedFile = event.target.files[0];

                if (selectedFile) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImageEdit.src = e.target.result;
                        previewImageEdit.style.display = 'block';
                    }

                    reader.readAsDataURL(selectedFile);
                }
            });

            $('#editModal').on('show.bs.modal', function(e) {
                var url = $(e.relatedTarget).data('url');
                var name = $(e.relatedTarget).data('name');
                var type = $(e.relatedTarget).data('type');
                var price = $(e.relatedTarget).data('price');
                var qty = $(e.relatedTarget).data('qty');
                var date = $(e.relatedTarget).data('date');
                var remark = $(e.relatedTarget).data('remark');
                var unit_id = $(e.relatedTarget).data('unit_id');
                var photo_url = $(e.relatedTarget).data('photo_url');

                document.getElementById("editForm").action = url;
                $('#name_edit').val(name);
                $('#type_edit').val(type);
                $('#price_edit').val(price);
                $('#qty_edit').val(qty);
                $('#date_edit').val(date);
                $('#unit_id_edit').val(unit_id);
                $('#remark_edit').val(remark);

                const previewImageEdit = document.getElementById('previewImageEdit');

                if (photo_url) {
                    previewImageEdit.src = photo_url;
                    previewImageEdit.style.display = 'block';
                } else {
                    previewImageEdit.src = '';
                    previewImageEdit.style.display = 'none';
                }
            });

            $('#photoModal').on('show.bs.modal', function(e) {
                var photo = $(e.relatedTarget).data('photo');

                document.getElementById("photo_modal").src = photo;
            });
        });
    </script>
@endsection
