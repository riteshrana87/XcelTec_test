<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeMaster;
use App\Models\Department;
use App\Models\EmployeeSalary;
use Auth;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeesController extends Controller
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
    
    /*
        @Author : Ritesh Rana
        @Desc   : Display a listing of the resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 17/09/2022
    */
    public function index(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_employees_managemnet.js";

        $dataQuery = EmployeeMaster::orderBy('id', 'DESC');
        if ($request->has('search_by_user_name') && $request->search_by_user_name != '') {
           $dataQuery->where('employee_name', 'like', '%' . $request->search_by_user_name . '%')
           ->orWhere('email', 'like', '%' . $request->search_by_user_name . '%');
        }
        $data = $dataQuery->paginate(5);
        //$currentUserData = User::find(Auth::id()); 
        return view('admin.employees.index', compact('data','request','footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for creating a new resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 17/09/2022
    */
    public function create(Request $request)
    {

        $headerCss[0] = "admin/css/select2.css";
        $headerCss[1] = "admin/css/uppy.min.css";

        $footerJs[0]    = "admin/js/select2.min.js";
        $footerJs[1]    = "admin/js/jquery.validate.min.js";
        $footerJs[2]    = "admin/js/uppy.min.js";
        $footerJs[3]    = "admin/customJs/admin_employees_managemnet.js";

        $department = Department::get();

        return view('admin.employees.add', compact('request','footerJs','headerCss','department'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Store a newly created resource in storage.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 17/09/2022
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required',
            'email' =>'required|email|unique:users',
            'department' =>'required',
        ]);

        if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

        $employee = new EmployeeMaster();
        $employee->employee_name = $request->name;
        $employee->department_id = $request->department;
        $employee->employee_work_email = $request->email;
        $employee->status = $request->status;
        $employee->save();

        $employee_salary = new EmployeeSalary();
        $employee_salary->employee_id = $employee->id;
        $employee_salary->salary = $request->salary;
        $employee_salary->save();
        
        alert()->success('Employee added successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/employees_management');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Display the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/09/2022
    */
    public function show($id)
    {
        //
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for editing the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/09/2022
    */
    public function edit(Request $request,$id)
    {
        $headerCss[0] = "admin/css/demo.css";
        $headerCss[1] = "admin/css/uppy.min.css";

        $footerJs[0]    = "admin/js/select2.min.js";
        $footerJs[1]    = "admin/js/jquery.validate.min.js";
        $footerJs[2]    = "admin/js/uppy.min.js";
        $footerJs[3]    = "admin/customJs/admin_employees_managemnet.js";
        
        $empdata = EmployeeMaster::with('salary','department')->find($id);
        $department = Department::get();
        
        return view('admin.employees.edit', compact('request','empdata','footerJs','headerCss','department'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Update the specified resource in storage.
        @Input  : \Illuminate\Http\Request  $request and int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/09/2022
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employee_master,employee_work_email,'.$id.',id',
            'department' =>'required',
        ]);
        //Update Employee detail
        $employee = EmployeeMaster::find($id);
        $employee->employee_name = $request->name;
        $employee->department_id = $request->department;
        $employee->employee_work_email = $request->email;
        $employee->status = $request->status;
        $employee->save();
        
        //delete old Data
        $category = EmployeeSalary::where('employee_id',$employee->id)->delete();

        //add employee salaray data
        $employee_salary = new EmployeeSalary();
        $employee_salary->employee_id = $employee->id;
        $employee_salary->salary = $request->salary;
        $employee_salary->save();

         alert()->success('Employee updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/employees_management');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Remove the specified resource from storage.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/09/2022
    */
    public function destroy($id)
    {
        $category = EmployeeMaster::find($id)->delete();
        alert()->success('Employee deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/employees_management');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for editing the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/09/2022
    */
    public function profile()
    {
        $id = Auth::user()->id;
        $headerCss[0] = "admin/css/demo.css";
        
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_employees_managemnet.js";

        $userdata = User::find($id);
        return view('admin.employees.profile', compact('userdata','footerJs','headerCss'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Update the specified resource in storage.
        @Input  : \Illuminate\Http\Request  $request and int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/09/2022
    */
    public function profileUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
        ]);

         $user = User::find($id);
         $user->name = $request->name;
         $user->email = $request->email;
         $user->address = $request->address;
         $user->phone = (int)$request->phone;
         $user->save();

         alert()->success('User updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/profile');
    }
}
