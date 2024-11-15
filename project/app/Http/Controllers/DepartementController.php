<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departements;

class DepartementController extends Controller
{
    public function index(Request $req){
        $object_data = [];
        $object_data['datawebsite'] = [];
        $object_data['datawebsite']['title'] = 'Data Departement';
        $object_data['datawebsite']['footer'] = 'Fullstack Dev Fleetifly Mahmud November 2024';
        return view('pages.departement',$object_data);
    }

    public function data(Request $req){
        date_default_timezone_set('Asia/Jakarta');
        $page = $req->get('page',1);
        $dataset = Departements::orderBy('id','desc')->paginate(100);
        return response()->json($dataset);
    }

    public function postData(Request $req){

        $object_data = [];

        $departement_name = $req->departement_name;
        if(!$departement_name){
            $object_data['status'] = 500;
            $object_data['messages'] = "Departement Name Mandatory";
            return response()->json($object_data);
        }
        $max_clock_in_time = $req->max_clock_in_time;
        if(!$max_clock_in_time){
            $object_data['status'] = 500;
            $object_data['messages'] = "Max Close In Time Mandatory";
            return response()->json($object_data);
        }
        $max_clock_out_time = $req->max_clock_out_time;
        if(!$max_clock_out_time){
            $object_data['status'] = 500;
            $object_data['messages'] = "Max Close Out Time Mandatory";
            return response()->json($object_data);
        }

        Departements::create([
            'departement_name' => $departement_name, 'max_clock_in_time' => $max_clock_in_time, 'max_clock_out_time' => $max_clock_out_time
        ]);

        $object_data['status'] = 200;
        $object_data['messages'] = "Save Successfull";

        return response()->json($object_data);
        
    }

    public function editData(Request $req, $id){

        $object_data = [];
        error_log($req->departement_name);
        $departement_name = $req->input('departement_name');
        if(!$departement_name){
            $object_data['status'] = 500;
            $object_data['messages'] = "Departement Name Mandatory";
            return response()->json($object_data);
        }
        $max_clock_in_time = $req->input('max_clock_in_time');
        if(!$max_clock_in_time){
            $object_data['status'] = 500;
            $object_data['messages'] = "Max Close In Time Mandatory";
            return response()->json($object_data);
        }
        $max_clock_out_time = $req->input('max_clock_out_time');
        if(!$max_clock_out_time){
            $object_data['status'] = 500;
            $object_data['messages'] = "Max Close Out Time Mandatory";
            return response()->json($object_data);
        }

        Departements::where('id',$id)->update([
            'departement_name' => $departement_name, 'max_clock_in_time' => $max_clock_in_time, 'max_clock_out_time' => $max_clock_out_time
        ]);

        $object_data['status'] = 200;
        $object_data['messages'] = "Save Successfull";

        return response()->json($object_data);
        
    }

    public function deleteData(Request $req, $id){
        Departements::where('id',$id)->delete();
        $object_data = [];
        $object_data['status'] = 200;
        $object_data['messages'] = "Delete Successfull";
        return response()->json($object_data);
    }

}
