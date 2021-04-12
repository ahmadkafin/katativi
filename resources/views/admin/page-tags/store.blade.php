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
                        <form method="post" id="form-tags" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="title">Nama Tags</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukan Nama hashtag" value="{{old('name')}}" />
                                        <small class="name_err text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="Status">Hashtag ini akan langsung di aktif?</label>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" value="1">
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline ml-3">
                                                <input class="form-check-input" type="radio" name="status" value="0">
                                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                            </div>
                                        </div>
                                        <small class="status_err text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto text-center">
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-info" type="submit" id="submit-tags">Submit</button>
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
            index_tags : "{{route('tags')}}",
            store_tags : "{{route('tags.store')}}",
        }
    };
</script>
<script>
    if($('textarea').val() != '' || $('input').val() != ''){
        window.onbeforeunload = function() {
            return 'Are you sure you want to navigate away from this page?';
        };
    }
</script>
<script src="{{asset('js/page-tags-store.js')}}"></script>

@endpush

@push('styles')

@endpush