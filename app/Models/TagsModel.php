<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagsModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tbl_tags';
    protected $guarded = ['id'];

    public function pivot()
    {
        return $this->hasOne(PivotModel::class, 'tags_id', 'id');
    }

    public function pivots()
    {
        return $this->hasMany(PivotModel::class, 'tags_id');
    }

    public function pivota()
    {
        return $this->hasOneThrough(PivotModel::class, ArtikelModel::class, 'id', 'artikel_id');
    }
}
