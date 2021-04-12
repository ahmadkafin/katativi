<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Repositories;
use App\Services\PopulateData;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    protected $repo;
    private $rubrik = KategoriModel::class;

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
        $select    = ['id', 'name', 'slugs', 'created_at', 'jml_klik', 'status'];
        $rubrik = $this->repo->get($this->rubrik, $relation, $select);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'data'      => $rubrik
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Rubrik';
        return view('admin.page-rubrik.store', compact(['title']));
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
            $data = new PopulateData;
            $id = ['id' => ''];
            $this->repo->store($this->rubrik, $data->data_rubrik($request), $id);
            DB::commit();
            return response()->json([
                'status'    => Response::HTTP_CREATED,
                'message'   => 'Berhasil menambahkan rubrik'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => $e->getMessage(),
                'validation' => $data->validator_rubrik($request)->getMessageBag()->toArray()
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
        $title = 'Edit Rubrik';
        $rubrik = $this->repo->find($this->rubrik, $relation, $id);
        return view('admin.page-rubrik.edit', compact(['title', 'rubrik']));
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
            $data = new PopulateData;
            $this->repo->store($this->rubrik, $data->data_rubrik($request), $id);
            DB::commit();
            return response()->json([
                'status'    => Response::HTTP_ACCEPTED,
                'message'   => 'Sukses Update data'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => $e->getMessage(),
                'validation' => $data->validator_update_rubrik($request)->getMessageBag()->toArray(),
            ]);
        }
    }

    /**
     * Show data for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Artikel terkait rubrik';
        return view('admin.page-rubrik.show', compact(['title']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $this->repo->destroy($this->rubrik, $id);
        return response()->json([
            'status'    => Response::HTTP_ACCEPTED,
            'message'   => 'berhasil di hapus'
        ]);
    }


    /**
     * Display listing of the trash resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index_trash()
    {
        $select = ['id', 'name', 'slugs', 'deleted_at'];
        $trashes = $this->repo->trash($this->rubrik, $select);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'data'      => $trashes
        ]);
    }

    /**
     * Remove permanently some data.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function shred($id)
    {
        $this->repo->shred($this->rubrik, $id);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'      => 'Berhasil menghapus permanen'
        ]);
    }


    /**
     * Remove permanently all data.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function shreds()
    {
        $this->repo->shreds($this->rubrik);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'      => 'Berhasil menghapus permanen'
        ]);
    }

    /**
     * Restore all data.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function restores()
    {
        $this->repo->restores($this->rubrik);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'      => 'Berhasil mengembalikan semua data'
        ]);
    }

    /**
     * Restore some data.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $this->repo->restore($this->rubrik, $id);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'      => 'Berhasil mengembalikan data'
        ]);
    }

    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(KategoriModel::class, 'slugs', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
