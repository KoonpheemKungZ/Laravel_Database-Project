<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::paginate(10);
        #$departments = DB::table('departments')->get();
        return view('admin.department.index',compact('departments'));
    }
    public function store(Request $request){
        #dd($request->department_name);
        $request->validate([
            'department_name' => 'required|unique:departments|max:255',
            'department_image' => 'required|mimes:ipg,jpeg,png'
        ],
        [   'department_name.required' => "กรุณป้อนชื่อเเผนกด้วยครับ",
            'department_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
            'department_name.unique' => "มีข้อมูลชื่อเเผนกอยู่ในฐานข้อมูลอยู่เเล้ว",
            'department_image.required' => "กรุณาใส่รูปภาพด้วยครับ"]
        

    );
    //บันทึกข้อมูล
    // $department = new Department;
    // $department -> department_name = $request -> department_name;
    // $department -> user_id = Auth::user() -> id;
    // $department -> save();

    //เข้ารหัสรูป
    $department_image = $request -> file('department_image');
    //สร้างชื่อภาพ
    $name_gen = hexdec(uniqid());
    //ดึงนามสกุลไฟล๋
    $img_ext = strtolower($department_image -> getClientOriginalExtension());
    $img_name = $name_gen.'.'.$img_ext;
    //บันทึกภาพ
    $upload_location = 'image/departments/';
    $full_path = $upload_location.$img_name;


    $data = array();
    $data["department_name"] = $request -> department_name;
    $data["department_image"] = $request -> department_image;
    $data["user_id"] = Auth::user() -> id;

    //Quary Builder
    #DB::table('departments') -> insert($data);
    #DB::table('departments') -> insert($data)
    Department::insert([
        'department_name' => $request -> department_name,
        'department_image' => $full_path,
        'user_id' => Auth::user() -> id,
        'product_price' => $request -> product_price,
    ]);
    $department_image -> move($upload_location,$img_name);
    return redirect() -> back() -> with('success', "บันทึกข้อมูลเรียบร้อย");
    }

    public function edit($id){
        $department = Department::find($id);
        return view('admin.department.edit',compact('department'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'department_name' => 'required|unique:departments|max:255'
        ],
        [   'department_name.required' => "กรุณป้อนชื่อเเผนกด้วยครับ",
            'department_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
            'department_name.unique' => "มีข้อมูลชื่อเเผนกอยู่ในฐานข้อมูลอยู่เเล้ว"]
    );
    $update = Department::find($id) -> update([
        'department_name' => $request -> department_name,
        'product_price' => $request -> product_price,
        'user_id' => Auth::user() -> id
    ]);

    return redirect() -> route('department') -> with('success', "อัพเดดข้อมูลเรียบร้อย");
    }

    public function softdelete($id){
        $delete = Department::find($id) -> forceDelete();
        return redirect() -> back() -> with('success', "ลบข้อมูลเรียบร้อย");
    }
}
