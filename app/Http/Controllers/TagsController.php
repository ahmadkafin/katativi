<?php

namespace App\Http\Controllers;

use App\Models\TagsModel;
use App\Repositories\Repositories;
use App\Services\PopulateData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    protected $repo;
    private $tags = TagsModel::class;

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
        $select = ['id', 'name', 'status', 'count', 'created_at'];
        $tags = $this->repo->get($this->tags, $relation, $select);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'data'      => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Tags';
        return view('admin.page-tags.store', compact(['title']));
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
            $this->repo->store($this->tags, $data->data_tags($request), $id);
            DB::commit();
            return response()->json([
                'status'    => Response::HTTP_CREATED,
                'message'   => 'Berhasil menambahkan tags'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => $e->getMessage(),
                'validation' => $data->validator_tags($request)->getMessageBag()->toArray()
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
        $title = 'Edit Tags';
        $tags = $this->repo->find($this->tags, $relation, $id);
        return view('admin.page-tags.edit', compact(['title', 'tags']));
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
            $this->repo->store($this->tags, $data->data_tags($request), $id);
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
                'validation' => $data->validator_tags($request)->getMessageBag()->toArray(),
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
        $this->repo->destroy($this->tags, $id);
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
        $select = ['id', 'name', 'deleted_at'];
        $trashes = $this->repo->trash($this->tags, $select);
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
        $this->repo->shred($this->tags, $id);
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
        $this->repo->shreds($this->tags);
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
        $this->repo->restores($this->tags);
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
        $this->repo->restore($this->tags, $id);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'      => 'Berhasil mengembalikan data'
        ]);
    }
}
