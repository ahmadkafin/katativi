<?php

namespace App\Services;

use App\Models\ArtikelModel;
use App\Models\VisitorModel;

class DashboardService
{
    public function chart_artikel_klik()
    {
        $artikel = ArtikelModel::select('title', 'counting_klik')->where('status', 1)->get();
        $a = [];
        $b = [];
        $values = [];
        $titles = [];
        foreach ($artikel as $arr) {
            $a[] = $arr->counting_klik;
            $b[] = $arr->title;
        }
        $sum = array_sum($a);
        $average = $sum / count($a);
        // $max = a[0];
        for ($i = 0; $i < count($a); $i++) {
            if ($average > 0) {
                if ($a[$i] >= $average) {
                    $values[] = $a[$i];
                    $titles[] = $b[$i];
                }
            }
        }
        return [$values, $titles];
    }

    public function locations()
    {
        $visitor = VisitorModel::get();
        $locations = $visitor->toArray();
        return $locations;
    }

    public function count_visitor()
    {
        $charts = VisitorModel::selectRaw('kota, COUNT(*) as kc')->groupBy('kota')->get();
        $charts = $charts->toArray();
        $charts_kota = [];
        $charts_count = [];
        for ($i = 0; $i < count($charts); $i++) {
            $charts_kota[] = $charts[$i]['kota'];
            $charts_count[] = $charts[$i]['kc'];
        }
        return [$charts_kota, $charts_count];
    }
}
