<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('home', compact('user'));
    }

    // For general datatable
    /*
        public function getUsers()
        {
            return Datatables::of(User::query())->make(true);
        }
    */

    // Row Editing
    public function getUsers()
    {
        try {
            return DataTables::of(User::query())
//                ->setRowClass(function ($user) {
//                    return $user->id % 2 == 0 ? 'alert-success' : 'alert-warning';
//                })
                ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')
                ->make(true);
        } catch (\Exception $e) {
        }
    }
}
