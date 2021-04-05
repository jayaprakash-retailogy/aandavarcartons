<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Response, Redirect;
use App;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function create() {
        $employees = Employee::all();
        $data = ['employees' => $employees];
        return view('employee.list')->with($data);
    }

    public function submit(Request $reqeust) {
        $user_id = Auth::id();

        $employee_name = strtoupper(request('name'));
        $employee_address = strtoupper(request('address'));
        $employee_phone = request('phone');
        $employee_email = request('email');
        $employee_aadhar = request('aadhar');
        $employee_pan = strtoupper(request('pan'));
        $employee_salary = request('salary');

        $employee = new Employee();
        $employee->name = $employee_name;
        $employee->address = $employee_address;
        $employee->phone = $employee_phone;
        $employee->email = $employee_email;
        $employee->aadhar = $employee_aadhar;
        $employee->pan = $employee_pan;
        $employee->salary = $employee_salary;
        $employee->users_id = $user_id;

        if($employee->save()) {
            $data = ['message' => "Successfully added employee data", 'status' => 'success', 'code' => '200'];
        } else {
            abort(500);
        }

        return back()->with($data);
    }

    public function employeeStatus($id, $status) {
        $update = Employee::where('id', $id)->update(['is_active' => $status]);

        if($update) {
            $data = ['code' => '200', 'status' => 'success', 'message' => 'Successfully updated employee'];
        } else {
            $data = ['code' => '100', 'status' => 'failure', 'message' => 'Something went wrong. Try again later'];
        }

        return back()->with($data);
    }

    public function editCreate($id) {
        $employee = Employee::where('id', $id)->first();
        $data = ['employee' => $employee];

        return response()->json($data);
    }

    public function editSubmit(Request $reqeust) {
        $user_id = Auth::id();

        $employee_id = request('id');
        $employee_name = strtoupper(request('name'));
        $employee_address = strtoupper(request('address'));
        $employee_phone = request('phone');
        $employee_email = request('email');
        $employee_aadhar = request('aadhar');
        $employee_pan = strtoupper(request('pan'));
        $employee_salary = request('salary');

        $employee = Employee::find($employee_id);

        $employee->name = $employee_name;
        $employee->address = $employee_address;
        $employee->phone = $employee_phone;
        $employee->email = $employee_email;
        $employee->aadhar = $employee_aadhar;
        $employee->pan = $employee_pan;
        $employee->salary = $employee_salary;

        if($employee->save()) {
            $data = ['message' => "Successfully updated employee data", 'status' => 'success', 'code' => '200'];
        } else {
            abort(500);
        }

        return back()->with($data);
    }
}
