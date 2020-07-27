@extends('layouts.admin')

@section('content')
    <section class=" mb-5">
        <h6 class="page-title font-weight-600">Adauga Categorie</h6>
    </section>
    <div class="card">
        <div class="card-header bg-admin-blue">
            <h6 class="font-weight-600 text-white mb-0">
                Informatii Categorie
            </h6>
        </div>
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="required font-weight-600">Denumire categorie</label>
                            <input type="text" class="form-control" placeholder="ex. Clinica Victor Babes">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="required font-weight-600">Denumire categorie</label>
                            <select type="text" class="custom-select form-control">
                                <option value="Categorie NOUA">Categorie NOUA</option>
                                <option value="Oncologie">Oncologie</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="font-weight-600">Descriere</label>
                            <textarea name="" id="mytextarea" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="pb-3 mt-3 clearfix">
                    <button type="submit" id="submit-button-2" class="btn btn-secondary pull-right btn-lg px-6">
                        <span class="btn-inner--icon mr-2"><i class="fa fa-plus"></i></span>
                        <span class="btn-inner--text">Adauga</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/bgsado4b682dgf10owt5ns07i6jh5vcf36tc06nntxc08asr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endsection
