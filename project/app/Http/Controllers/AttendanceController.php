<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Departements;
use App\Models\Attendances;
use App\Models\AttendanceHistory;

class AttendanceController extends Controller
{
    public function index(Request $req){
        $object_data = [];
        $object_data['datawebsite'] = [];
        $object_data['datawebsite']['title'] = 'Data Log Absensi Karyawan';
        $object_data['datawebsite']['footer'] = 'Fullstack Dev Fleetifly Mahmud November 2024';
        $departement = Departements::orderBy('id','desc')->get();
        $object_data['departement'] = $departement;
        return view('pages.attendance',$object_data);
    }

    public function data(Request $req){
        date_default_timezone_set('Asia/Jakarta');
        $search = $req->get('search');
        $date_attendance = $req->get('date_attendance');
        $dataset = AttendanceHistory::with('employee','attendance')->orderBy('date_attendance','desc');
        if($date_attendance){
            $dataset = $dataset->where('date_attendance','LIKE','%'.$date_attendance.'%');
        }
        if($search){
            $dataset = $dataset->whereHas('employee',function($query) use ($search){
                $query->whereHas('departement',function($query) use ($search){
                    $query->where('departement_name','LIKE','%'.$search.'%');
                });
            });
        }
        $dataset = $dataset->limit(100)->get();
        $json = [];
        foreach($dataset as $rowindex){
            $dataemployee = Employees::with('departement')->where('employee_id',$rowindex['employee']['employee_id'])->first();
            $obj_data = [
                'id' => $rowindex->id, 'employee' => $rowindex['employee'], 'attendance' => $rowindex['attendance'],
                'date_attendance' => $rowindex->date_attendance, 'attendance_type' => $rowindex->attendance_type=='1'?'Absen Masuk':'Absen Keluar'
            ];
            if($dataemployee){
                $date_attendance = $rowindex->date_attendance;
                $date_attendance = date('H:i:s', strtotime($date_attendance));

                $clock_in = $dataemployee['departement']['clock_in'];
                $clock_in = date('H:i:s', strtotime($clock_in));
                
                $clock_out = $dataemployee['departement']['clock_out'];
                $clock_out = date('H:i:s', strtotime($clock_out));
                
                if($rowindex->attendance_type == '1'){

                    $diffInSeconds = strtotime($date_attendance) - strtotime($clock_in);
                    
                    $hours = floor($diffInSeconds / 3600);
                    $minutes = floor(($diffInSeconds % 3600) / 60);
                    $seconds = $diffInSeconds % 60;
    
                    if ($diffInSeconds > 0) {
                        $obj_data['status'] = "Terlambat $hours jam $minutes menit $seconds detik";
                    }else{
                        $obj_data['status'] = "Lebih Awal $hours jam $minutes menit $seconds detik";
                    }
                }else{
                    $diffInSeconds = strtotime($clock_out)-strtotime($date_attendance);
                    
                    $hours = floor($diffInSeconds / 3600);
                    $minutes = floor(($diffInSeconds % 3600) / 60);
                    $seconds = $diffInSeconds % 60;
    
                    if ($diffInSeconds > 0) {
                        $obj_data['status'] = "Pulang Lebih Awal $hours jam $minutes menit $seconds detik";
                    }else{
                        $obj_data['status'] = "Pulang Tepat Waktu $hours jam $minutes menit $seconds detik";
                    }
                }

                $obj_data['departement_name'] = $dataemployee['departement']['departement_name'];

            }else{
                $obj_data['status'] = "Belum Absen";
                $obj_data['departement_name'] = '-';
            }
            $json[] = $obj_data;
        }
        return response()->json([
            'data' => $json
        ]);
    }
}
