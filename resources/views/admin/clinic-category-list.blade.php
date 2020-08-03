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
            <a href="{{ route('admin.clinic-category-add') }}" class="btn btn-success btn-sm text-white px-4">Adauga categorie</a>
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
                                <a href="#" class="btn btn-sm btn-link text-primary">Editeaza</a>
                                <a href="#" class="btn btn-sm btn-link text-danger">Sterge</a>
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
                    <a href="#" class="btn btn-sm btn-outline-primary mb-2 mb-sm-0">Editeaza Categoria</a>
                    <a href="#" class="btn btn-sm btn-outline-danger mb-2 mb-sm-0">Sterge Categoria</a>
                    <a href="#" class="btn btn-sm btn-secondary mb-2 mb-sm-0">Adauga Subcategorie</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection
