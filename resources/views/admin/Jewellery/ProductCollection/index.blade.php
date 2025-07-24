@extends('admin.layouts.master')

@section('main_section')
    <style>
        .dt-thumbnail {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        table.dataTable td.dt-control:before {
            content: '\f0fe';
            font-family: FontAwesome;
            color: #317cb1;
            margin-right: 10px;
            cursor: pointer;
        }
        table.dataTable td.dt-control:before {
            height: 1em;
            width: 1em;
            margin-top: -9px;
            display: inline-block;
            color: white;
            border: .15em solid white;
            border-radius: 1em;
            box-shadow: 0 0 .2em #444;
            box-sizing: content-box;
            text-align: center;
            text-indent: 0 !important;
            font-family: "Courier New", Courier, monospace;
            line-height: 1em;
            content: "+";
            background-color: #337ab7;
        }

        .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
            cursor: pointer;
        }

        .image-preview-container {
            position: relative;
            display: inline-block;
        }

        .remove-image {
            position: absolute;
            top: 0;
            right: 0;
            background: red;
            color: white;
            padding: 2px 6px;
            border-radius: 50%;
            cursor: pointer;
        }
        
        .video-preview-container {
            max-width: 100%;
            margin-top: 10px;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="mb-0">Product Collections</h4>
                <button class="btn btn-primary" id="createCollectionBtn">Add New Collection</button>
            </div>
            <div class="card-body table-responsive text-nowrap">
                <table id="collectionsTable" class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Display in Menu</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="collectionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="collectionForm" class="modal-content" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="collectionId">
                <input type="hidden" name="remove_image" id="removeImage" value="0">
                <input type="hidden" name="remove_banner" id="removeBanner" value="0">
                <input type="hidden" name="remove_banner_video" id="removeBannerVideo" value="0">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Collection Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Collection Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control">
                                <small class="text-danger error-name"></small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Heading</label>
                                <input type="text" name="heading" id="heading" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $parent)
                                        <optgroup label="{{ $parent->category_name }}" data-parent-id="{{ $parent->category_id }}">
                                            <option value="parent_{{ $parent->category_id }}">
                                                {{ $parent->category_name }} (Parent)
                                            </option>
                                            @foreach($parent->children as $child)
                                                <option value="{{ $child->category_id }}">
                                                    {{ $child->category_name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Collection Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="collection_image" name="collection_image">
                                <small class="text-danger error-collection_image"></small>
                                <div class="mt-2" id="imagePreview"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Banner Image</label>
                                <input type="file" class="form-control" id="banner_image" name="banner_image">
                                <div class="mt-2" id="bannerPreview"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Banner Video (Max 500MB)</label>
                                <input type="file" class="form-control" id="banner_video" name="banner_video">
                                <div class="mt-2" id="bannerVideoPreview"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alias</label>
                                <input type="text" name="alias" id="alias" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control" value="0">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Code -->
    <script>
        $(document).ready(function () {
            const storageUrl = "{{ url('storage') }}";

            const collectionsTable = $('#collectionsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('collections.index') }}",
                columns: [
                    { className: 'dt-control', orderable: false, data: null, defaultContent: '' },
                    { data: 'id', name: 'id' },
                    { 
                        data: 'collection_image', 
                        name: 'collection_image',
                        render: function(data) {
                            return data ? `<img src="${storageUrl}/${data}" class="dt-thumbnail">` : 'No image';
                        }
                    },
                    { data: 'name', name: 'name' },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    { 
                        data: 'status', 
                        name: 'status',
                        render: (data, type, row) => `
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input status-toggle" 
                                    data-id="${row.id}" ${data == 1 ? 'checked' : ''}>
                            </div>`
                    },
                    { 
                        data: 'display_in_menu', 
                        name: 'display_in_menu',
                        render: (data, type, row) => `
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input display-toggle" 
                                    data-id="${row.id}" ${data == 1 ? 'checked' : ''}>
                            </div>`
                    }
                ],
                order: [[1, 'desc']]
            });

            function format(row) {
                return `
                    <div class="p-2">
                        <strong>Heading:</strong> ${row.heading || '-'}<br>
                        <strong>Description:</strong> ${row.description || '-'}<br>
                        <strong>Alias:</strong> ${row.alias || '-'}<br>
                        <strong>Sort Order:</strong> ${row.sort_order || 0}<br>
                        <div class="mt-2">
                            <button class="btn btn-sm btn-info editCollectionBtn" data-id="${row.id}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger deleteCollectionBtn" data-id="${row.id}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                `;
            }


            $('#collectionsTable tbody').on('click', 'td.dt-control', function () {
                const tr = $(this).closest('tr');
                const row = collectionsTable.row(tr);

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });

            $('#createCollectionBtn').click(() => {
                $('#collectionForm')[0].reset();
                $('#collectionId').val('');
                $('#removeImage').val('0');
                $('#removeBanner').val('0');
                $('#removeBannerVideo').val('0');
                $('#imagePreview, #bannerPreview, #bannerVideoPreview').html('');
                $('.text-danger').text('');
                $('#modalTitle').text('Create New Collection');
                $('#category_id').val('');
                $('#collectionModal').modal('show');
            });

            // Handle image previews and removal
            $('#collection_image').change(function () {
                handleImagePreview(this, '#imagePreview', '#removeImage');
            });

            $('#banner_image').change(function () {
                handleImagePreview(this, '#bannerPreview', '#removeBanner');
            });
            
            $('#banner_video').change(function () {
                handleVideoPreview(this, '#bannerVideoPreview', '#removeBannerVideo');
            });

            function handleImagePreview(input, previewSelector, removeFlagSelector) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        $(previewSelector).html(`
                            <div class="image-preview-container">
                                <img src="${e.target.result}" width="150">
                                <span class="remove-image" data-flag="${removeFlagSelector}">×</span>
                            </div>`);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            function handleVideoPreview(input, previewSelector, removeFlagSelector) {
                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const videoUrl = URL.createObjectURL(file);
                    $(previewSelector).html(`
                        <div class="video-preview-container">
                            <video width="150" controls>
                                <source src="${videoUrl}" type="${file.type}">
                            </video>
                            <span class="remove-video" data-flag="${removeFlagSelector}">×</span>
                        </div>
                    `);
                }
            }

            $(document).on('click', '.remove-image, .remove-video', function () {
                const flagSelector = $(this).data('flag');
                $(flagSelector).val('1');
                $(this).closest('.image-preview-container, .video-preview-container').remove();
                $(previewSelector).append('<div class="text-danger mt-2">File will be removed on save</div>');
            });

            $('#collectionForm').submit(function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                const id = $('#collectionId').val();
                const url = id ? "{{ route('collections.update', ['id' => ':id']) }}".replace(':id', id) 
                                : "{{ route('collections.store') }}";

                // Set display_in_menu based on category selection
                formData.append('display_in_menu', $('#category_id').val() ? '0' : '1');

                $.ajax({
                    url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: res => {
                        $('#collectionModal').modal('hide');
                        toastr.success(res.message);
                        collectionsTable.ajax.reload();
                    },
                    error: xhr => {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (let field in errors) {
                                $(`.error-${field}`).text(errors[field][0]);
                            }
                        } else {
                            toastr.error('Failed to save collection');
                        }
                    }
                });
            });
            
            $(document).on('click', '.editCollectionBtn', function () {
                const id = $(this).data('id');
                $.get("{{ route('collections.edit', ['id' => ':id']) }}".replace(':id', id), function (data) {
                    $('#collectionId').val(data.id);
                    $('#removeImage').val('0');
                    $('#removeBanner').val('0');
                    $('#removeBannerVideo').val('0');
                    $('#name').val(data.name);
                    $('#heading').val(data.heading);
                    $('#description').val(data.description);
                    $('#alias').val(data.alias);
                    $('#sort_order').val(data.sort_order);
                    $('#category_id').val(data.category_id);

                    if (data.collection_image) {
                        const imageUrl = `${storageUrl}/${data.collection_image}`;
                        $('#imagePreview').html(`
                            <div class="image-preview-container">
                                <img src="${imageUrl}" width="150" class="mb-2">
                                <span class="remove-image" title="Remove image" data-flag="#removeImage">×</span>
                            </div>`);
                    } else {
                        $('#imagePreview').html('');
                    }

                    if (data.banner_image) {
                        const bannerUrl = `${storageUrl}/${data.banner_image}`;
                        $('#bannerPreview').html(`
                            <div class="image-preview-container">
                                <img src="${bannerUrl}" width="150" class="mb-2">
                                <span class="remove-image" title="Remove banner" data-flag="#removeBanner">×</span>
                            </div>`);
                    } else {
                        $('#bannerPreview').html('');
                    }
                    
                    if (data.banner_video) {
                        const videoUrl = `${storageUrl}/${data.banner_video}`;
                        $('#bannerVideoPreview').html(`
                            <div class="video-preview-container">
                                <video width="150" controls>
                                    <source src="${videoUrl}">
                                </video>
                                <span class="remove-video" title="Remove video" data-flag="#removeBannerVideo">×</span>
                            </div>
                        `);
                    } else {
                        $('#bannerVideoPreview').html('');
                    }

                    $('.text-danger').text('');
                    $('#modalTitle').text('Edit Collection');
                    $('#collectionModal').modal('show');
                });
            });

            $(document).on('click', '.deleteCollectionBtn', function () {
                if (!confirm('Are you sure?')) return;
                const id = $(this).data('id');
                $.ajax({
                    url: "{{ route('collections.destroy', ['id' => ':id']) }}".replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: res => {
                        toastr.success(res.message);
                        collectionsTable.ajax.reload();
                    },
                    error: () => toastr.error('Delete failed')
                });
            });

            $(document).on('change', '.status-toggle', function () {
                const id = $(this).data('id');
                const status = this.checked ? 1 : 0;

                $.ajax({
                    url: "{{ route('collections.status', ['id' => ':id']) }}".replace(':id', id),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: res => toastr.success(res.message),
                    error: () => toastr.error('Failed to update status')
                });
            });

            $(document).on('change', '.display-toggle', function () {
                const id = $(this).data('id');
                const display = this.checked ? 1 : 0;

                $.ajax({
                    url: "{{ route('collections.display', ['id' => ':id']) }}".replace(':id', id),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        display: display
                    },
                    success: res => toastr.success(res.message),
                    error: () => toastr.error('Failed to update display setting')
                });
            });
        });
    </script>
@endsection