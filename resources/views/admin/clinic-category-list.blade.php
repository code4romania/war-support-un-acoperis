@extends('layouts.admin')

@section('content')
    <section class=" mb-5">
        <h6 class="page-title font-weight-600">Categorii clinici</h6>
    </section>
    <div class="card shadow-sm rounded">
        <div class="card-header rounded bg-admin-blue py-3 d-flex justify-content-between align-content-center">
            <h6 class="font-weight-600 text-white mb-0">
                Categorii
            </h6>
            <a href="{{ route('admin.clinic-category-add') }}" class="btn btn-success btn-sm text-white px-4">Adaugă categorie</a>
        </div>
    </div>
    <div class="row row-cols-2">
    @foreach($categories as $category)
        <div class="col-12 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header border-bottom py-3">
                    <h5 class="font-weight-600 mb-0 text-admin-blue">{{ $category->name }}</h5>
                </div>
                <div class="card-body">
                @if (!empty($category->children()->count()))
                    <ul class="list-group custom-list-group mb-4">
                    @foreach($category->children as $children)
                        <li class="list-group-item py-2 d-flex justify-content-between align-content-center">
                            <span>{{ $children->name }}</span>
                            <div class="actions">
                                <a href="{{ route('admin.clinic-category-edit', $children->id) }}" class="btn btn-sm btn-link text-primary">Editează</a>
                                <a href="{{ route('admin.clinic-category-delete', $children->id) }}" class="btn btn-sm btn-link text-danger delete-subcategory" data-id="{{ $children->id }}">Șterge</a>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                @endif
                    <p class="mb-0 smaller">
                        {!! $category->description !!}
                    </p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.clinic-category-edit', $category->id) }}" class="btn btn-sm btn-outline-primary mb-2 mb-sm-0">Editează Categoria</a>
                    <a href="{{ route('admin.clinic-category-delete', $category->id) }}" class="btn btn-sm btn-outline-danger mb-2 mb-sm-0 delete-category" data-id="{{ $category->id }}">Șterge Categoria</a>
                    <a href="{{ route('admin.clinic-category-add', $category->id) }}" class="btn btn-sm btn-secondary mb-2 mb-sm-0 add-subcategory" data-id="{{ $category->id }}">Adaugă Subcategorie</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <!-- Confirmare stergere categorie -->
    <div class="modal fade bd-example-modal-sm" id="deleteCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Șterge categorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Ești sigur că vrei să ștergi categoria selectată?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">Renunță</button>
                    <button type="button" class="btn btn-danger" id="proceedDeleteCategory">Șterge</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmare stergere subcategorie -->
    <div class="modal fade bd-example-modal-sm" id="deleteSubCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Șterge subcategorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Ești sigur că vrei să ștergi subcategoria selectată?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal" id="cancel">Renunță</button>
                    <button type="button" class="btn btn-danger" id="proceedDeleteSubCategory">Șterge</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            let selectedCategory = null;
            let selectedSubCategory = null;

            $('.delete-category').on('click', function(event) {
                event.preventDefault();
                selectedCategory = $(this).data('id');
                $('#deleteCategory').modal('show');
            });

            $('.delete-subcategory').on('click', function(event) {
                event.preventDefault();
                selectedSubCategory = $(this).data('id');
                $('#deleteSubCategory').modal('show');
            });

            $('#proceedDeleteCategory').on('click', function() {
                $('#deleteCategory').modal('hide');
                window.location.href = '/admin/clinic/category/delete/' + selectedCategory;
            });

            $('#proceedDeleteSubCategory').on('click', function() {
                $('#deleteSubCategory').modal('hide');

                window.location.href = '/admin/clinic/category/delete/' + selectedSubCategory;
            });
        });
    </script>
@endsection
