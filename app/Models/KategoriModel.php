<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriModel extends Model
{
    use HasFactory, Sluggable, SoftDeletes;
    protected $table = 'tbl_kategori';
    protected $guarded = ['id'];


    public function pivots()
    {
        return $this->hasMany(PivotModel::class, 'kategori_id');
    }


    /**
     * Return the sluggable config array for this model
     * 
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slugs' => [
                'source' => 'name'
            ]
        ];
    }
}
