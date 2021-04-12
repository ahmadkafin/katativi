<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Repositories;
use App\Services\RegServices;
use App\Services\UserService;
use App\Services\UsersService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $repo;
    private $users = User::class;

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
        $select = ['id', 'name', 'username', 'roles', 'permission'];
        $data = $this->repo->get($this->users, $relation, $select);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'data'      => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $title = "Tambah User";
        return view('admin.page-user.store', compact(['title']));
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
            $data = new RegServices;
            $id = ['id' => ''];
            $this->repo->store($this->users, $data->data_user($request), $id);
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
                'validation'   => $data->validation_user($request)->getMessageBag()->toArray()
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
        $title = 'Edit Users';
        $user = $this->repo->find($this->users, $relation, $id);
        return view('admin.page-user.edit', compact(['title', 'user']));
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
            $data = new RegServices;
            $this->repo->store($this->users, $data->data_user($request), $id);
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
                'validation' => $data->validation_user($request)->getMessageBag()->toArray(),
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
        $this->repo->destroy($this->users, $id);
        return response()->json([
            'status'    => Response::HTTP_ACCEPTED,
            'message'   => 'berhasil di hapus'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_pw($username)
    {
        $relation = [];
        $title = 'Ganti Password';
        $user = User::where('username', $username)->firstOrFail();
        return view('admin.page-user.pw-change', compact(['title', 'user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_pw(Request $request, $username)
    {
        DB::beginTransaction();
        try {
            $user = User::where('username', $username)->firstOrFail();
            if (Auth::user()->username === $user->username) {
                User::where('username', $username)->update([
                    'password'  => Hash::make($request->password),
                ]);
                DB::commit();
                return response()->json([
                    'status'    => Response::HTTP_ACCEPTED,
                    'message'   => 'Berhasil merubah password'
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'status'    => Response::HTTP_NOT_ACCEPTABLE,
                    'message'   => 'Kamu tidak berhak merubah password user ini!'
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'    => Response::HTTP_BAD_REQUEST,
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
