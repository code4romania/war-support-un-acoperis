@extends('layouts.admin')

@section('content')
    <section class=" mb-5">
        <h6 class="page-title font-weight-600">Adaugă Categorie</h6>
    </section>
    <div class="card">
        <div class="card-header bg-admin-blue">
            <h6 class="font-weight-600 text-white mb-0">
                Informații Categorie
            </h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.clinic-category-create', $preselectedParent) }}" name="add-category" id="add-category">
                @csrf

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name" class="required font-weight-600">Denumire categorie:</label>
                            <input type="text" class="form-control" placeholder="ex. Oncologie" name="name" id="name">

                            @error('name')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="parent" class="font-weight-600">Părinte categorie:</label>
                            <select type="text" class="custom-select form-control" name="parent" id="parent" {{ $preselectedParent ? 'disabled' : '' }}>
                                <option value=""></option>
                                @foreach($parents as $speciality)
                                    <option value="{{ $speciality->id }}" {{ (($preselectedParent ?? old('parent')) == $speciality->id ? 'selected' : '') }}>{{ $speciality->name }}</option>
                                @endforeach
                            </select>

                            @error('parent')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name_english" class="required font-weight-600">Denumire categorie engleză:</label>
                            <input type="text" class="form-control" placeholder="ex. Oncology" name="name_english" id="name_english">

                            @error('name_english')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description" class="font-weight-600">Descriere:</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>

                            @error('description')
                            <span class="invalid-feedback d-flex" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="pb-3 mt-3 clearfix">
                    <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                        <span class="btn-inner--text">Salvează</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src='{{config('tiny.url')}}' referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#description',
             menubar: false,
             toolbar: null
        });
    </script>
@endsection
