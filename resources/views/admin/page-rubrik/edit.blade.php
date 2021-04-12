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
                        <form method="post" id="form-update-rubrik" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="title">Nama Rubrik</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukan Nama Rubrik" value="{{$rubrik->name}}" />
                                        <small class="name_err text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="slugs">Url rubrik</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon3">katativi.com/</span>
                                            <input type="text" class="form-control" name="slugs" id="slugs"
                                                placeholder="Url Artikel" value="{{$rubrik->slugs}}" />
                                        </div>
                                        <small class="slugs_err text-danger"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="Status">Rubrik ini akan langsung di aktif?</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status" value="1"
                                                        {{$rubrik->status === 1 ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                                                </div>
                                                <div class="form-check form-check-inline ml-3">
                                                    <input class="form-check-input" type="radio" name="status" value="0"
                                                        {{$rubrik->status === 0 ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                                </div>
                                            </div>
                                            <small class="status_err text-danger"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto text-center">
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-info" type="submit" id="update-rubrik">Submit</button>
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
<script>
    var config = {
        routes: {
            slugs:'{{route("rubrik.slug")}}',
            index_rubr : "{{route('rubrik')}}",
            update_rubr : "{{route('rubrik.update', ':id')}}",
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
<script src="{{asset('js/page-rubrik-update.js')}}"></script>

@endpush

@push('styles')

@endpush