<?php

namespace App\Http\Controllers;

use App\Models\ArtikelModel;
use App\Models\PivotModel;
use App\Repositories\Repositories;
use App\Services\PopulateData;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ArtikelController extends Controller
{
    protected $repo, $arModel;
    private $artikel = ArtikelModel::class;
    private $pivot = PivotModel::class;

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
        $select = ['id', 'title', 'slugs', 'created_at', 'status', 'counting_klik'];
        $artikels = $this->repo->get($this->artikel, $relation, $select);
        return response()->json([
            'status'    => 200,
            'data'      => $artikels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $title = "Tambah Artikel";
        $kategoris = \App\Models\KategoriModel::select(['id', 'name'])->get();
        $tags = \App\Models\TagsModel::select(['id', 'name'])->get();
        return view('admin.page-artikel.store', compact(['title', 'kategoris', 'tags']));
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
            $artikel = $this->repo->store($this->artikel, $data->data_artikel($request), $id);
            $jml_tag = $request->tags;
            foreach ($jml_tag as $jml) {
                $this->repo->store($this->pivot, $data->pivot_artikel($artikel->id, $request, $jml), $id);
            }
            DB::commit();
            return response()->json([
                'status'    => Response::HTTP_CREATED,
                'message'   => 'sukses'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'       => Response::HTTP_BAD_REQUEST,
                'message'      => $e->getMessage(),
                'validation'   => $data->validator_artikel($request)->getMessageBag()->toArray()
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
        $artikel = $this->repo->find($this->artikel, $relation, $id);
        $kategoris = \App\Models\KategoriModel::select('id', 'name')->get();
        // $tags = \App\Models\TagsModel::select('id', 'name')->get();
        $tags = \App\Models\TagsModel::select('id', 'name')->with('pivot')->get();
        return view('admin.page-artikel.edit', compact([
            'artikel', 'title', 'kategoris', 'tags'
        ]));
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
            $artikel = $this->repo->store($this->artikel, $data->update_data_artikel($request), $id);
            $this->pivot::where('artikel_id', $id)->update($data->update_pivot_kategori($request));
            $jml_tag = $request->tags;
            $artikel->tags()->sync($jml_tag);
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
                'validation'   => $data->validator_update_artikel($request)->getMessageBag()->toArray()
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
        $this->repo->destroy($this->artikel, $id);
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
        $select = ['id', 'title', 'slugs', 'deleted_at'];
        $trashes = $this->repo->trash($this->artikel, $select);
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
        $this->repo->shred($this->artikel, $id);
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
        $this->repo->shreds($this->artikel);
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
        $this->repo->restores($this->artikel);
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
        $this->repo->restore($this->artikel, $id);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'      => 'Berhasil mengembalikan data'
        ]);
    }

    public function getSlug(Request $request)
    {
        $slug = SlugService::createSlug(ArtikelModel::class, 'slugs', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
