<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class SettingService
{

    public function validator_ads_store($request)
    {
        $rules = [
            'nama_brand'   => 'required|max:150',
            'url_iklan'    => 'required|active_url',
            'jenis_iklan'  => 'required',
            'status'       => 'required',
            'image_iklan'  => 'file|image|mimes:jpeg,png,jpg,gif|max:1024'
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public function ads_data_store($request)
    {
        if ($request->file('image_brand')) {
            return [
                'nama_brand'    => $request->nama_brand,
                'url_iklan'     => $request->url_iklan,
                'jenis_iklan'   => $request->jenis_iklan,
                'status'        => $request->status,
                'harga_iklan'   => $this->jenis_iklan($request),
                'masa_waktu'    => $request->masa_waktu,
                'image_brand'   => $this->image_iklan($request)
            ];
        } else {
            return [
                'nama_brand'    => $request->nama_brand,
                'url_iklan'     => $request->url_iklan,
                'jenis_iklan'   => $request->jenis_iklan,
                'status'        => $request->status,
                'harga_iklan'   => $this->jenis_iklan($request),
                'masa_waktu'    => $request->masa_waktu,
            ];
        }
    }

    private function image_iklan($request)
    {
        if ($request->file('image_brand')) {
            $image  = $request->file('image_brand');
            $name   = 'ads' . time() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('/img/image-iklan');
            $image->move($destination, $name);
            return $name;
        }
    }

    private function jenis_iklan($request)
    {
        switch ($request->jenis_iklan) {
            case 'platinum':
                return '5000000';
                break;
            case 'gold':
                return '3000000';
                break;
            case 'silver':
                return '1500000';
                break;
            case 'bronze':
                return '500000';
                break;
        }
    }
}
