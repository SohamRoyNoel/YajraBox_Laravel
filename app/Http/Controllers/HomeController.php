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

//    // Row Editing
//    public function getUsers()
//    {
//        try {
//            return DataTables::of(User::query())
////                ->setRowClass(function ($user) {
////                    return $user->id % 2 == 0 ? 'alert-success' : 'alert-warning';
////                })
//                ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')
//                ->make(true);
//        } catch (\Exception $e) {
//        }
//    }

//    // Row id
//    public function getUsers()
//    {
//
//            return DataTables::of(User::query())->setRowId(function ($user) {
//                    return $user->id;
//                })->make(true);
//
//    }

    // Row Attribute
//    public function getUsers()
//    {
//
//        return DataTables::of(User::query())
//            ->setRowAttr([
//                'align' => 'center',
//            ])
//            ->make(true);
//
//    }

//    // Row Data
//    // make changes on existing data from DB :: Dynamically on Table
//    public function getUsers()
//    {
//
//        return DataTables::of(User::query())
//            ->setRowData([
//                'data-id' => 'row-{{$id}}',
//                'data-name' => 'row-{{$name}}',
//            ])
//            ->make(true);
//    }
//    // Dynamic changes will be done on .blade page :: where INITIATIVES of yajra is defined via JQUERY (app.blade)

    // COLUMN

    // Add Columns
        public function getUsers()
    {

        return DataTables::of(User::query())
            ->addColumn('intro', function(User $user) {
                return 'Hi ' . $user->name . '!';
            })

            // Edit column - CLOSURE
            ->editColumn('created_at', function(User $user) {
                return $user->created_at->diffForHumans();
            })

            // Edit column - VIEW :: you need to put this attribute at home.blade & app.blade as well
                // 2. It only shows thr RAW HTML code; instead of he HTML CONTROL
                // 3. SOLUTION -> RAW Columns
            ->editColumn('actions', 'columnBladePage')
            ->rawColumns(['actions', 'action']) // It can accept array of COLUMNS
            ->toJson();
    }
}
