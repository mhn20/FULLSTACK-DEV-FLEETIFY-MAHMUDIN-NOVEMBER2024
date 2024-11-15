<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Departements;
use App\Models\Attendances;
use App\Models\AttendanceHistory;

class EmployeeController extends Controller
{

    public function dokumentasi(Request $req){
        $object_data = [];
        $object_data['datawebsite'] = [];
        $object_data['datawebsite']['title'] = 'Dokumentasi';
        $object_data['datawebsite']['footer'] = 'Fullstack Dev Fleetifly Mahmud November 2024';
        $departement = Departements::orderBy('id','desc')->get();
        $object_data['departement'] = $departement;
        return view('pages.dokumentasi',$object_data);
    }


    public function index(Request $req){
        $object_data = [];
        $object_data['datawebsite'] = [];
        $object_data['datawebsite']['title'] = 'Data Karyawan';
        $object_data['datawebsite']['footer'] = 'Fullstack Dev Fleetifly Mahmud November 2024';
        $departement = Departements::orderBy('id','desc')->get();
        $object_data['departement'] = $departement;
        return view('pages.karyawan',$object_data);
    }

    public function data(Request $req){
        date_default_timezone_set('Asia/Jakarta');
        $search = $req->get('search');
        $dataset = Employees::with('departement')->orderBy('id','desc');
        if($search){
            $dataset = $dataset->where(function($query) use ($search){
                $query->orwhere('name','LIKE','%'.$search.'%')->orwhere('address','LIKE','%'.$search.'%')
                ->orwhereHas('departement',function($query) use ($search){
                    $query->where('departement_name','LIKE','%'.$search.'%');
                });
            });
        }
        $dataset = $dataset->limit(100)->get();
        $json = [];
        foreach($dataset as $rowindex){
            $cekdata = Attendances::where('employee_id',$rowindex->employee_id)->where('clock_in' ,'LIKE', '%'.date('Y-m-d').'%');
            $vcekdata = $cekdata->first();
            $qtycekdata = $cekdata->count();
            $obj_data = [
                'id' => $rowindex->id, 'employee_id' => $rowindex->employee_id, 'departement_id' => $rowindex->departement_id,
                'name' => $rowindex->name, 'address' => $rowindex->address, 'departement' => $rowindex->departement
            ];
            $obj_data['qty_attendance'] = $qtycekdata;
            if($qtycekdata > 0){
                if($vcekdata->clock_in){
                    $obj_data['clock_in'] = $vcekdata->clock_in;
                }else{
                    $obj_data['clock_in'] = '-';
                }
                if($vcekdata->clock_out){
                    $obj_data['clock_out'] = $vcekdata->clock_out;
                }else{
                    $obj_data['clock_out'] = '-';
                }
            }else{
                $obj_data['clock_in'] = '-';
                $obj_data['clock_out'] = '-';
            }
            $json[] = $obj_data;
        }
        return response()->json([
            'data' => $json
        ]);
    }

    public function postData(Request $req){
        date_default_timezone_set('Asia/Jakarta');

        $object_data = [];

        $departement_id = $req->departement_id;
        if(!$departement_id){
            $object_data['status'] = 500;
            $object_data['messages'] = "Departement Mandatory";
            return response()->json($object_data);
        }
        $name = $req->name;
        if(!$name){
            $object_data['status'] = 500;
            $object_data['messages'] = "name Mandatory";
            return response()->json($object_data);
        }
        $address = $req->address;
        if(!$address){
            $object_data['status'] = 500;
            $object_data['messages'] = "Address Mandatory";
            return response()->json($object_data);
        }

        Employees::create([
            'departement_id' => $departement_id, 'employee_id' => date('YmdHis'), 'name' => $name, 'address' => $address
        ]);

        $object_data['status'] = 200;
        $object_data['messages'] = "Save Successfull";

        return response()->json($object_data);
        
    }

    public function editData(Request $req, $id){

        $object_data = [];

        $departement_id = $req->departement_id;
        if(!$departement_id){
            $object_data['status'] = 500;
            $object_data['messages'] = "Departement Mandatory";
            return response()->json($object_data);
        }
        $name = $req->name;
        if(!$name){
            $object_data['status'] = 500;
            $object_data['messages'] = "name Mandatory";
            return response()->json($object_data);
        }
        $address = $req->address;
        if(!$address){
            $object_data['status'] = 500;
            $object_data['messages'] = "Address Mandatory";
            return response()->json($object_data);
        }

        Employees::where('id',$id)->update([
            'departement_id' => $departement_id, 'name' => $name, 'address' => $address
        ]);

        $object_data['status'] = 200;
        $object_data['messages'] = "Save Successfull";

        return response()->json($object_data);
        
    }

    public function absenMasuk(Request $req, $id){
        date_default_timezone_set('Asia/Jakarta');
        $dataemployee = Employees::where('id',$id)->first();
        $attendance_id = date('YmdHis');
        
        $cekdata = Attendances::where('employee_id',$dataemployee->employee_id)->where('clock_in' ,'LIKE', '%'.date('Y-m-d').'%');
        $object_data = [];
        if($cekdata->count() == 0){
            Attendances::create([
                'employee_id' => $dataemployee->employee_id,
                'attendance_id' => $attendance_id,
                'clock_in' => date('Y-m-d H:i:s')
            ]);

            AttendanceHistory::create([
                'employee_id' => $dataemployee->employee_id,
                'attendance_id' => $attendance_id,
                'date_attendance' => date('Y-m-d H:i:s'),
                'attendance_type' => 1, 'description' => 'Absen Masuk'
            ]);
            $object_data['status'] = 200;
            $object_data['messages'] = "Save Successfull";
        }else{
            $object_data['status'] = 500;
            $object_data['messages'] = "Absen Masuk Available";
        }

        return response()->json($object_data);
    }

    public function absenKeluar(Request $req, $id){
        date_default_timezone_set('Asia/Jakarta');
        $dataemployee = Employees::where('id',$id)->first();
        $attendance_id = date('YmdHis');

        $cekdata = Attendances::where('employee_id',$dataemployee->employee_id)->where('clock_in' ,'LIKE', '%'.date('Y-m-d').'%');
        $object_data = [];
        if($cekdata->count() > 0){
            $cekdataout = Attendances::where('employee_id',$dataemployee->employee_id)->where('clock_out' ,'LIKE', '%'.date('Y-m-d').'%');
            if($cekdataout->count() == 0){
                $cekdata->update([
                    'clock_out' => date('Y-m-d H:i:s')
                ]);
                $cekdata = $cekdata->first();
                AttendanceHistory::create([
                    'employee_id' => $dataemployee->employee_id,
                    'attendance_id' => $cekdata->attendance_id,
                    'date_attendance' => date('Y-m-d H:i:s'),
                    'attendance_type' => 2, 'description' => 'Absen Keluar'
                ]);
                $object_data['status'] = 200;
                $object_data['messages'] = "Save Successfull";
            }else{
                $object_data['status'] = 500;
                $object_data['messages'] = "Absen Keluar Available";
            }
        }else{
            $object_data['status'] = 500;
            $object_data['messages'] = "Absen Masuk Not Available";
        }
        

        return response()->json($object_data);
    }

    public function deleteData(Request $req, $id){
        Employees::where('id',$id)->delete();
        $object_data = [];
        $object_data['status'] = 200;
        $object_data['messages'] = "Delete Successfull";
        return response()->json($object_data);
    }

}
