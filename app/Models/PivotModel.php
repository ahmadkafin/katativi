<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PivotModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tbl_pivot_artikel_kategori';
    protected $guarded = ['id'];

    public function artikels()
    {
        return $this->belongsTo(ArtikelModel::class, 'artikel_id');
    }

    public function kategoris()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id');
    }

    public function tags()
    {
        return $this->belongsTo(TagsModel::class, 'tags_id');
    }
}
