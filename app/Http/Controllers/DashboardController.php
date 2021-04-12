<?php

namespace App\Http\Controllers;

use App\Models\AdsModel;
use App\Models\ArtikelModel;
use App\Models\User;
use App\Models\VisitorModel;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location as Loc;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        // $userIp = $request->ip();
        // $dataL = Loc::get();
        // $dataL = $dataL->toArray();
        // dd($dataL);
        $dshbrd = new DashboardService;
        $title = 'Dashboard';
        $data = [
            'artikel_count'     => ArtikelModel::count(),
            'visitor_count'     => VisitorModel::count(),
            'users_count'       => User::count(),
            'ads_count'         => AdsModel::count(),
            'chart_klik'        => $dshbrd->chart_artikel_klik(),
            'loc'               => $dshbrd->locations(),
            'count_vis'         => $dshbrd->count_visitor(),
            'revenue_total'     => AdsModel::sum('harga_iklan'),
            'revenue_platinum'  => AdsModel::where('jenis_iklan', 'platinum')->sum('harga_iklan'),
            'revenue_gold'      => AdsModel::where('jenis_iklan', 'gold')->sum('harga_iklan'),
            'revenue_silver'    => AdsModel::where('jenis_iklan', 'silver')->sum('harga_iklan'),
            'revenue_bronze'    => AdsModel::where('jenis_iklan', 'bronze')->sum('harga_iklan'),
        ];
        // dd($data['count_vis']);
        return view('admin.page-dashboard.index', compact(['title', 'data']));
    }

    public function charts()
    {
        $artikel = ArtikelModel::select('name', 'counting_klik')->max('counting_klik')->limit('5')->get();
    }
}
