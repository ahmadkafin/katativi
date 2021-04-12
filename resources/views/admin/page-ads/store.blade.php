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
                        <form method="post" id="form-ads" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="nama_brand">Masukan nama brand</label>
                                        <input type="text" class="form-control" id="nama_brand" name="nama_brand"
                                            placeholder="Masukan nama brand" value="{{old('nama_brand')}}" />
                                        <small class="nama_brand_err text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="url_iklan">Url Iklan</label>
                                        <input type="text" class="form-control" name="url_iklan" id="url_iklan"
                                            placeholder="Url iklan eg: instagram, twitter, tokped, dll"
                                            value="{{old('url_iklan')}}" />
                                        <small class="url_iklan_err text-danger"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 col-sm-12 col-lg-6">
                                    <label for="kategori">Jenis Iklan</label>
                                    <select class="form-select" size="5" name="jenis_iklan" id="jenis_iklan"
                                        aria-label="size 5 select example">
                                        <option disabled>Pilih jenis iklan</option>
                                        <option value="platinum">Platinum</option>
                                        <option value="gold">Gold</option>
                                        <option value="silver">Silver</option>
                                        <option value="bronze">Bronze</option>
                                    </select>
                                    <small class="jenis_iklan_err text-danger"></small>
                                </div>

                                <div class="col-md-12 col-sm-12 col-lg-6">
                                    <label for="kategori">Masa Waktu iklan sampai kapan?</label>
                                    <div class="form-group mt-4">
                                        <input data-provide="datepicker" name="masa_waktu" value="{{old('masa_waktu')}}"
                                            class="form-control">
                                    </div>
                                    <small class="masa_waktu_err text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="Status">Apakah iklan ini akan langsung aktif?</label>
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
                                            <label class="input-group-text" for="image_brand">Gambar Iklan?</label>
                                            <input type="file" class="form-control" name="image_brand" id="image_brand">
                                        </div>
                                        <small class="image_brand_err text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto text-center">
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-info" type="submit" id="submit-ads">Submit</button>
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
@include('include._modals')
@endsection

@push('scripts')
<script src="{{asset('vendor/adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
    integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
    crossorigin="anonymous"></script>
<script>
    var config = {
        data: {
            _token: " {{csrf_token()}}", 
        }, 
        routes: { 
            index: "{{route('ads')}}" , 
            store : "{{route('ads.store')}}" , 
            } 
    }; 
</script>
<script>
    if($('input').val() != ''){
        window.onbeforeunload = function() {
            return 'Are you sure you want to navigate away from this page?';
        };
    }
</script>
<script src="{{asset('js/page-ads-store.js')}}"></script>
@endpush

@push('styles')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
    crossorigin="anonymous" />
@endpush