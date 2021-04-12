<?php

namespace App\Http\Controllers;

use App\Models\AdsModel;
use Illuminate\Http\Request;
use App\Repositories\Repositories;
use App\Services\SettingService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    protected $repo;
    private $ads = AdsModel::class;
    public function __construct(Repositories $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display listing of the resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $relation = [];
        $select = ['id', 'nama_brand', 'jenis_iklan', 'status', 'harga_iklan', 'masa_waktu'];
        $ads = $this->repo->get($this->ads, $relation, $select);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'data'      => $ads
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $title = "Tambah Ads";
        return view('admin.page-ads.store', compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = new SettingService;
            $id = ['id' => ''];
            $this->repo->store($this->ads, $data->ads_data_store($request), $id);
            DB::commit();
            return response()->json([
                'status'    => Response::HTTP_CREATED,
                'message'   => 'Iklan telah di buat! :)'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'       => Response::HTTP_BAD_REQUEST,
                'message'      => $e->getMessage(),
                'validation'   => $data->validator_ads_store($request)->getMessageBag()->toArray()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relation = [];
        $title = 'Edit artikel';
        $ads = $this->repo->find($this->ads, $relation, $id);
        return view('admin.page-ads.edit', compact(['ads', 'title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $id = ['id' => $id];
            $data = new SettingService;
            $this->repo->store($this->ads, $data->ads_data_store($request), $id);
            DB::commit();
            return response()->json([
                'status'    => Response::HTTP_ACCEPTED,
                'message'   => 'Sukses update data'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'       => Response::HTTP_BAD_REQUEST,
                'message'      => $e->getMessage(),
                'validation'   => $data->validator_ads_store($request)->getMessageBag()->toArray()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->destroy($this->ads, $id);
        return response()->json([
            'status'    => Response::HTTP_ACCEPTED,
            'message'   => 'berhasil di hapus'
        ]);
    }
}
