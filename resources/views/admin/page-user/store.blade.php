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
                        <form method="post" id="form-user" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Nama User</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukan nama user" value="{{old('name')}}" />
                                        <small class="name_err text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Masukan username" value="{{old('name')}}" />
                                        <small class="username_err text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Masukan email" value="{{old('email')}}" />
                                        <small class="email_err text-danger"></small>
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

                            <div class="row mb-5">
                                <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="Status">Roles untuk user ini?</label>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <input type="radio" name="roles" value="admin">
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" value="Admin" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <input type="radio" name="roles" value="User">
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" value="user" readonly />
                                            </div>
                                        </div>
                                        <small class="roles_err text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="Status">Permission untuk user ini?</label>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <input type="radio" name="permission" value="1">
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" value="Full Access" readonly />
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" type="button"
                                                        id="tooltip_fullaccess" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Bisa melakukan input, update dan delete data"><i
                                                            class="fas fa-question"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <input type="radio" name="permission" value="0">
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" value="Read Only" readonly />
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-warning" type="button"
                                                        id="tooltip_readonly" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Tidak bisa melakukan input, update dan delete data"><i
                                                            class="fas fa-question"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="permission_err text-danger"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="mx-auto text-center">
                                        <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-info" type="submit" id="submit-users">Submit</button>
                                            <button class="btn btn-danger">Cancel</button>
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
            index : "{{route('users')}}",
            store : "{{route('users.store')}}",
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
<script src="{{asset('js/page-users-store.js')}}"></script>

@endpush

@push('styles')

@endpush