<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use App\Models\Classes;
use App\Models\Whislists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhislistsController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }    


    public function index()
    {
        if(!Auth::check()){
            return response()->json([
                'code' => 404,
                'message' => 'You Must Login For Add My Whistlist'
            ]);
        }
        
        $whis = Whislists::all();
        return response()->json([
                'whislists' => $whis,
                'code' => 200,
                'message' => 'Succesfully list whislists'
            ]);
    }

    public function create_save(Request $request)
    {
        if(!Auth::check()){
            return response()->json([
                'code' => 404,
                'message' => 'You Must Login For Add My Whistlist'
            ]);
        }

        $saveWhislists = new Whislists;
        $saveWhislists->idusers = Auth::user()->idusers;
        $saveWhislists->idclass = $request->input('idclass');

        $userExists = Whislists::where('idclass', '=', 'idclass' )->first();
        if ($userExists === null) {
            return response()->json([
                'code' => 400,
                'message' => 'Whislists Class available'
            ]);
        }

        $saveWhislists->save();

        

        return response()->json([
            'addWhislists' => $saveWhislists,
            'code' => 200,
            'message' => 'Succesfully Add Whislists Class'
        ]);
    }
}
