<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Categories;
use App\Models\Subclass;
use App\Models\Hilights;
use App\Models\Materies;

class ClassController extends Controller
{
    public function index()
    {
        $class = Classes::all();
        return response()->json([
                'class' => $class,
                'code' => 200,
                'message' => 'Successfully'
        ]);
    }

    public function select_id($classes)
    {
        $cls = Classes::where('idclass',$classes)->get();
        return response()->json([
            'class' => $cls,
            'code' => 200,
            'message' => 'Succesfull'
        ]);
    }

    // use authentication
    public function index_auth()
    {
        $class = Classes::all();
        return response()->json([
                'class' => $class,
                'code' => 200,
                'message' => 'Successfully'
        ]);
    }

    public function select_id_auth($classes)
    {
        $cls = Classes::where('idclass',$classes)->get();
        return response()->json([
            'class' => $cls,
            'code' => 200,
            'message' => 'Succesfull'
        ]);
    }

    public function classdetail($classes)
    {
        $classdetail = Classes::with([
                            'subclass' => function($sub){
                                $sub->with('materies');
                            }
                        ])
                        ->where('idclass',$class)
                        ->first();
        
        return response()->json([
            'classdetail' => $classdetail,
            'code' => 200,
            'message' => 'ok'
        ]);

    }

    // Subclass
    public function index_subclass()
    {
        $sub = Subclass::all();
        return response()->json([
                'subclass' => $sub,
                'code' => 200,
                'message' => 'Successfully'
        ]);
    }

    public function select_subclass($subclass)
    {
        $sub = Subclass::where('idsubclass',$subclass)->get();
        return response()->json([
            'subclass' => $sub,
            'code' => 200,
            'message' => 'Succesfull'
        ]);
    }

    // Materies
    public function index_materies()
    {
        $mat = Materies::all();
        return response()->json([
                'materies' => $mat,
                'code' => 200,
                'message' => 'Successfully'
        ]);
    }

    public function select_materies($materies)
    {
        $mat = Materies::where('idmateries',$materies)->get();
        return response()->json([
            'materies' => $mat,
            'code' => 200,
            'message' => 'Succesfull'
        ]);
    }

    // Hilights
    public function index_hilights()
    {
        $hil = Hilights::all();
        return response()->json([
                'hilights' => $hil,
                'code' => 200,
                'message' => 'Successfully'
        ]);
    }

    public function select_hilights($hilights)
    {
        $hil = Hilights::where('idhilights',$hilights)->get();
        return response()->json([
            'hilights' => $hil,
            'code' => 200,
            'message' => 'Succesfull'
        ]);
    }

}
