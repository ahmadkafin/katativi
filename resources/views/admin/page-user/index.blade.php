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
                                <h3 class="card-title">List {{$title}}</h3>
                            </div>
                            <div class="col order-1">

                            </div>
                            <div class="col order-5">
                                <div class="card-title float-right">
                                    <a href="{{route('users.create')}}" class="btn btn-info btn-sm">+ Tambah
                                        Users</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tabel_users" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Roles</th>
                                    <th>Permission</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Roles</th>
                                    <th>Permission</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- real content --}}
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('vendor/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('vendor/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush
@push('scripts')
<!-- DataTables  & Plugins -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="{{asset('vendor/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendor/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="{{asset('vendor/datatable/js/dataTables.editor.min.js')}}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.15/dataRender/datetime.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>
<script>
    var config = {
        data: {
            _token: "{{csrf_token()}}",
        },
        routes: {
            index: "{{route('users.index')}}",
            edit: "{{route('users.edit', ':id')}}",
            destroy: "{{route('users.destroy', ':id')}}",
        }
    }
</script>
<script src="{{asset('js/page-users-index.js')}}"></script>
@endpush