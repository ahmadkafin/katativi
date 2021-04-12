@extends('layouts.admin-layout')

@section('content')
{{-- page title --}}
@include('include._page-title', ['title'])
{{-- page title --}}

{{-- real content --}}
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-title">{{$title}}</h3>
                            </div>
                            <div class="col order-1">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" id="form-artikel" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="title">Judul Artikel</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Masukan judul artikel" value="{{old('title')}}" />
                                        <small class="title_err text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="slugs">Url artikel</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon3">katativi.com/</span>
                                            <input type="text" class="form-control" name="slugs" id="slugs"
                                                placeholder="Url Artikel" value="{{old('title')}}" />
                                        </div>
                                        <small class="slugs_err text-danger"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 col-sm-12 col-lg-6">
                                    <label for="kategori">Rubrik</label>
                                    <select class="form-select" name="kategori" multiple aria-label="select example">
                                        <option selected disabled>Pilih Rubrik</option>
                                        @foreach ($kategoris as $kategori)
                                        <option value="{{$kategori->id}}">{{$kategori->name}}</option>
                                        @endforeach
                                    </select>
                                    <small class="rubrik_err text-danger"></small>
                                </div>

                                <div class="col-md-12 col-sm-12 col-lg-6">
                                    <label for="kategori">Tag</label>
                                    <select class="form-select" multiple name="tags[]"
                                        aria-label="Multiple select example">
                                        <option selected disabled>Pilih Tag</option>
                                        @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                        <small class="tags_err text-danger"></small>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="form-group">
                                    <label for="body">Isi artikel</label>
                                    <textarea id="body" name="body"></textarea>
                                    <small class="body_err text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="Status">Artikel ini akan langsung di published?</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="1">
                                                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                                                </div>
                                                <div class="form-check form-check-inline ml-3">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="0">
                                                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                                </div>
                                            </div>
                                            <small class="status_err text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-sm-12 mt-3">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="poster">Poster?</label>
                                            <input type="file" class="form-control" name="poster" id="poster">
                                        </div>
                                        <small class="poster_err text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto text-center">
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-info" type="submit" id="submit-artikel">Submit</button>
                                        <button class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- real content --}}
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    var config = {
        data: {
            _token: "{{csrf_token()}}",
            title: document.getElementById('title').value,
            slugs: document.getElementById('slugs').value,
            body: document.getElementById('body').value,
            status: document.getElementsByName('status').value,
        },
        routes: {
            slugs:'{{route("artikel.slug")}}',
            index_art : "{{route('artikel')}}",
            store_art : "{{route('artikel.store')}}",
        }
    };
</script>
<script>
    if($('textarea').val() == '' || $('input').val() == ''){
        window.onbeforeunload = function() {
            return 'Are you sure you want to navigate away from this page?';
        };
    }
</script>
<script src="{{asset('js/page-artikel-store.js')}}"></script>

@endpush

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush