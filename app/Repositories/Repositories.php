<?php

namespace App\Repositories;

class Repositories
{

    /**
     * Get All data
     * @param string $className
     * @param array $relation
     * @param array $select
     * 
     * @return \Illuminate\Http\JsonResponse
     */

    public function get(string $className, array $relation, array $select)
    {
        return $className::with($relation)->select($select)->get();
    }

    /**
     * store data
     * @param string $className
     * @param array $data
     * @param array $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(string $className, array $data, array $id)
    {
        return $className::updateOrCreate($id, $data);
    }

    /**
     * show single data
     * @param string $className
     * @param array $relation
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(string $className, array $relation, int $id)
    {
        return $className::where('id', $id)->with($relation)->firstOrFail();
    }

    /**
     * destroy data
     * @param string $className
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $className, int $id)
    {
        return $className::where('id', $id)->delete();
    }

    /**
     * trash file
     * @param string $className
     * @param array $select
     * @return \Illuminate\Http\JsonResponse
     */
    public function trash(string $className, array $select)
    {
        return $className::select($select)->onlyTrashed()->get();
    }

    /**
     * remove some file
     * @param string $className
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function shred(string $className, int $id)
    {
        return $className::onlyTrashed()->where('id', $id)->forceDelete();
    }

    /**
     * remove all file
     * @param string $className
     * @return \Illuminate\Http\JsonResponse
     */
    public function shreds(string $className)
    {
        return $className::onlyTrashed()->forceDelete();
    }

    /**
     * restore file
     * @param string $className
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(string $className, int $id)
    {
        return $className::onlyTrashed()->where('id', $id)->restore();
    }

    /**
     * restore all file
     * @param string $className
     * @return \Illuminate\Http\JsonResponse
     */
    public function restores(string $className)
    {
        return $className::onlyTrashed()->restore();
    }
}
