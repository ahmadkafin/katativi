@extends('layouts.admin-layout')

@section('content')
{{-- page title --}}
@include('include._page-title', ['title'])
{{-- page title --}}

{{-- real content --}}
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="far fa-newspaper"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Artikel</span>
                        <span class="info-box-number">
                            {{$data['artikel_count']}}
                            <small>Artikel</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-binoculars"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Visitor</span>
                        <span class="info-box-number">{{$data['visitor_count']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number">{{$data['users_count']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-ad"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Iklan Terpasang</span>
                        <span class="info-box-number">{{$data['ads_count']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-12 col-12">
                        <div class="description-block">
                            {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                17%</span> --}}
                            <h5 class="description-header">IDR {{number_format($data['revenue_total'], 0)}}</h5>
                            <span class="description-text">Pendapatan Iklan</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span
                                    class="description-percentage text-warning">{{number_format(($data['revenue_platinum'] / $data['revenue_total']) * 100, 0)}}%</span>
                                <h5 class="description-header">IDR {{number_format($data['revenue_platinum'], 0)}}</h5>
                                <span class="description-text">Revenue platinum</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span
                                    class="description-percentage text-success">{{number_format(($data['revenue_gold'] / $data['revenue_total']) * 100, 0)}}%</span>
                                <h5 class="description-header">IDR {{number_format($data['revenue_gold'], 0)}}</h5>
                                <span class="description-text">Revenue Gold</span>
                            </div>
                            <!-- /.description-block -->
                        </div>

                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span
                                    class="description-percentage text-success">{{number_format(($data['revenue_silver'] / $data['revenue_total']) * 100,0)}}%</span>
                                <h5 class="description-header">IDR {{number_format($data['revenue_silver'], 0)}}</h5>
                                <span class="description-text">Revenue Silver</span>
                            </div>
                            <!-- /.description-block -->
                        </div>

                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <span
                                    class="description-percentage text-danger">{{number_format(($data['revenue_bronze'] / $data['revenue_total']) * 100, 0)}}%</span>
                                <h5 class="description-header">IDR {{number_format($data['revenue_bronze'], 0)}}</h5>
                                <span class="description-text">Revenue Bronze</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-title">Visitor</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <!-- DONUT CHART -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Artikel paling banyak di baca</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body bg-white">
                                        <canvas id="donutChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Pengunjung</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body bg-white card-map">
                                        <div id="dashboard-map"></div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 col-sm-12">
                                <!-- BAR CHART -->
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Total pengunjung berdasarkan lokasi</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body bg-white">
                                        <div class="chart">
                                            <canvas id="barChart"
                                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- real content --}}
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
<style>
    .card-map {
        height: 290px;
    }

    #dashboard-map {
        height: 100%;
    }
</style>
@endpush
@push('scripts')
<!-- ChartJS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<script src="{{asset('vendor/adminlte/plugins/chart.js/Chart.min.js')}}"></script>
<script>
    var data = {
        klik: {!!json_encode($data['chart_klik'][0])!!},
        label: {!!json_encode($data['chart_klik'][1])!!},
        loc: {!!json_encode($data['loc'])!!},
        count_vis_kota : {!!json_encode($data['count_vis'][0])!!},
        count_vis_tot : {!!json_encode($data['count_vis'][1])!!},
    }
</script>
<script src="{{asset('js/page-dashboard-index.js')}}"></script>
@endpush