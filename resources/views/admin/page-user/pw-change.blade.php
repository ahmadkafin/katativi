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
                        <form method="post" id="form-update-password-user" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-5">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="password">Password Lama</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="old_password"
                                                name="old_password" placeholder="Masukan password" />
                                            <button class="btn btn-outline-warning" type="button"
                                                id="show-old">Show</button>
                                        </div>
                                        <small class="password_err text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Masukan password" />
                                            <button class="btn btn-outline-success" type="button"
                                                id="generate">Generate</button>
                                            <button class="btn btn-outline-warning" type="button"
                                                id="show">Show</button>
                                        </div>
                                        <small class="password_err text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="password-confirm">Masukan Kembali Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" placeholder="Masukan kembali password" />
                                        </div>
                                        <small class="password_err text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="mx-auto text-center">
                                        <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-info" type="submit"
                                                id="update-password-users">Submit</button>
                                            <a href="{{route('users')}}" class="btn btn-danger">Cancel</a>
                                        </div>
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
            index : "{{route('dashboard.index')}}",
            update : "{{route('update-pw.update', ':username')}}",
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
<script src="{{asset('js/page-update-pw.js')}}"></script>

@endpush

@push('styles')

@endpush