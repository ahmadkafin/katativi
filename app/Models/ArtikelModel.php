<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtikelModel extends Model
{
    use HasFactory, Sluggable, SoftDeletes;
    protected $table = 'tbl_artikel';
    protected $fillable = [
        'title',
        'slugs',
        'body',
        'status',
        'jenis',
        'counting_klik',
        'poster',
        'alt'
    ];

    public function kategori()
    {
        return $this->belongsToMany(ArtikelModel::class, 'tbl_pivot_artikel_kategori', 'artikel_id', 'kategori_id');
    }

    public function tags()
    {
        return $this->belongsToMany(ArtikelModel::class, 'tbl_pivot_artikel_kategori', 'artikel_id', 'tags_id');
    }

    public function pivots()
    {
        return $this->hasMany(PivotModel::class, 'artikel_id');
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
                'source' => 'title'
            ]
        ];
    }
}
