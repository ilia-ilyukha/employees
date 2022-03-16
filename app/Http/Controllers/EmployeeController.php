<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employers;
use URL;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $filter_data = [];
        $filter_data['start'] = $request->start ? $request->start : date('Y') . '-' . date('m');

        $limit = isset($request->limit) ? $request->limit : 0;
        $data['limit'] = $limit;
        $data['employers'] = $this->getList($filter_data, $limit);
        $data['period'] = $request->start ? $request->start : date('Y') . '-' . date('m');
        $data['current_link'] = URL::current();
        $data['departments'] = $this->getDepartments();
        if (!count($data['employers'])) {
            $data['empty'] = true;
            return view('employee.index', $data);
        }

        return view('employee.index', $data);
    }

    public function getList($filter_data, $limit = 0)
    {
        $start = $filter_data['start']; // Required parameter
        $department_code = isset($filter_data['department_code']) ? $filter_data['department_code'] : "";
        $filter_sql = "WHERE date >= '$start-01' AND date <= '$start-31'";

        $limit = ($limit != 0) ? $limit : 10;

        $query = DB::table('employers')
            ->leftJoin(DB::raw("(SELECT 
                employer_id,
                SUM(quantity) as hours                
                FROM employer_hour
                $filter_sql  
                GROUP BY employer_id
                ) as employers_hours"), function ($join) {
                $join->on('employers.id', '=', 'employers_hours.employer_id');
            })
            ->join('departments AS d', 'employers.department_id', '=', 'd.id')
            // 
            ->select(
                'employers.*',
                'employers_hours.hours',
                'd.name as department_name'
            );

        if (isset($filter_data['department_code'])) {
            $query->where('d.codename', '=', $department_code);
        }

        $results = $query->paginate($limit);

        foreach ($results as &$result) {
            $result->total_salary = ($result->salary_type == 2) ? $result->salary * $result->hours : $result->salary;
            $result->total_salary = number_format($result->total_salary, 2);
        }
        // dd($results);
        return $results;
    }

    public function department($department_code, Request $request)
    {
        $filter_data = [];
        $filter_data['start'] = $request->start ? $request->start : date('Y') . '-' . date('m');
        $filter_data['department_code'] =  $department_code;

        $limit = isset($request->limit) ? $request->limit : 0;
        $data['limit'] = $limit;

        $data['employers'] = $this->getList($filter_data, $limit);
        $data['period'] = $request->start ? $request->start : date('Y') . '-' . date('m');
        $data['current_link'] = URL::current();
        $data['departments'] = $this->getDepartments();

        if (!count($data['employers'])) {
            $data['empty'] = true;
            return view('employee.index', $data);
        }
        $data['department_name'] = $data['employers'][0]->department_name;
        $data['department_codename'] = $department_code;

        //  dd($data['department_codename']);
        return view('employee.index', $data);
    }

    public function getDepartments()
    {
        return DB::table('departments')->get();
    }
    public function import(Request $request)
    {
        if (isset($request->file)) {
            $request->file->storeAs('employes', 'employes.xml');
            echo "File has been uploaded!";                   

            $xmlDataString = file_get_contents(storage_path('app/employes/employes.xml'));
            $xmlObject = simplexml_load_string($xmlDataString);
            $json = json_encode($xmlObject);
            $phpDataArray = json_decode($json, true);
            Employers::insert($phpDataArray['employee']); 
        }
            
        return view('employee.import');
    }

}
