<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class PopulateData
{
    public function data_artikel($request)
    {
        $data =  [
            'title'     => $request->title,
            'slugs'     => $request->slugs,
            'body'      => $request->body,
            'status'    => $request->status,
            'poster'    => $this->imageUpload($request),
            'alt'       => 'poster-' . $request->slugs
        ];
        return $data;
    }

    public function validator_artikel($request)
    {
        $rules = [
            'title'     => 'required|max:150',
            'slugs'     => 'required|unique:tbl_artikel',
            'body'      => 'required',
            'status'    => 'required',
            'poster'    => 'required|file|image|mimes:jpeg,png,jpg,gif|max:1024'
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public function imageUpload($request)
    {
        if ($request->file('poster')) {
            $image  = $request->file('poster');
            $name   = time() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('/img/poster-artikel');
            $image->move($destination, $name);
            return $name;
        }
    }

    public function validator_update_artikel($request)
    {
        $rules = [
            'title'     => 'required|max:150',
            'slugs'     => 'required',
            'body'      => 'required',
            'status'    => 'required',
            'poster'    => 'file|image|mimes:jpeg,png,jpg,gif|max:1024'
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public function update_data_artikel($request)
    {
        if ($request->file('poster')) {
            $data =  [
                'title'     => $request->title,
                'slugs'     => $request->slugs,
                'body'      => $request->body,
                'status'    => $request->status,
                'poster'    => $this->imageUpload($request)
            ];
        } else {
            $data =  [
                'title'     => $request->title,
                'slugs'     => $request->slugs,
                'body'      => $request->body,
                'status'    => $request->status,
            ];
        }
        return $data;
    }

    public function validator_rubrik($request)
    {
        $rules = [
            'name'      => 'required|max:150',
            'slugs'     => 'required|unique:tbl_kategori',
            'status'    => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public function validator_update_rubrik($request)
    {
        $rules = [
            'name'      => 'required|max:150',
            'slugs'     => 'required',
            'status'    => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public function data_rubrik($request)
    {
        $data = [
            'name'      => $request->name,
            'slugs'     => $request->slugs,
            'status'    => $request->status,
        ];
        return $data;
    }

    public function pivot_artikel($artikel, $request, $jml)
    {
        return [
            'artikel_id'    => $artikel,
            'kategori_id'   => $request->kategori,
            'tags_id'       => $jml
        ];
    }

    public function update_pivot_kategori($request)
    {
        return [
            'kategori_id'   => $request->kategori,
        ];
    }

    public function validator_tags($request)
    {
        $rules = [
            'name'      => 'required|max:150|unique:tbl_tags',
            'status'    => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    public function data_tags($request)
    {
        $data = [
            'name'      => $request->name,
            'status'    => $request->status,
        ];
        return $data;
    }
}
