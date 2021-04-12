<?php

namespace App\Http\Controllers;

use App\Models\VisitorModel;
use Illuminate\Http\Request;
use App\Repositories\Repositories;
use Illuminate\Http\Response;

class VisitorController extends Controller
{
    protected $repo;
    private $vis = VisitorModel::class;

    public function __construct(Repositories $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $relation = [];
        $select = ['id', 'ip_visitor', 'kota'];
        $data = $this->repo->get($this->vis, $relation, $select);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'data'      => $data
        ]);
    }
}
