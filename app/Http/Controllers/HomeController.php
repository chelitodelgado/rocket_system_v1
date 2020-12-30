<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleUser;
use App\User;
use App\Producto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $products = Producto::latest()->get();
        // Solo usuairos con role todos los permisos
        $request->user()->authorizeRoles(['user', 'admin']);

        //$list = RoleUser::latest()->get();
        $list =  RoleUser::query('role_user')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->join('roles',  'role_user.role_id',  '=', 'roles.id')
            ->select('role_user.*',
                                'users.name',
                                'users.email',
                                'roles.description'
                    )
            ->get();

        return view('home',
            [
                'role'     => $request,
                'lists'    => $list,
                'products' => $products
            ]
        );

    }

}
