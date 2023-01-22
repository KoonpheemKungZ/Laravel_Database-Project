<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(10);
        #$departments = DB::table('departments')->get();
        return view('admin.product.index',compact('products'));
    }
    public function store(Request $request){
        #dd($request->department_name);
        $request->validate([
            'product_name' => 'required|unique:Products|max:255',
            'product_image' => 'required|mimes:ipg,jpeg,png'
        ],
        [   'product_name.required' => "กรุณป้อนชื่อเเผนกด้วยครับ",
            'product_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
            'product_name.unique' => "มีข้อมูลชื่อเเผนกอยู่ในฐานข้อมูลอยู่เเล้ว",
            'product_image.required' => "กรุณาใส่รูปภาพด้วยครับ"]
        

    );
    //บันทึกข้อมูล
    // $department = new Department;
    // $department -> department_name = $request -> department_name;
    // $department -> user_id = Auth::user() -> id;
    // $department -> save();

    //เข้ารหัสรูป
    $product_image = $request -> file('product_image');
    //สร้างชื่อภาพ
    $name_gen = hexdec(uniqid());
    //ดึงนามสกุลไฟล๋
    $img_ext = strtolower($product_image -> getClientOriginalExtension());
    $img_name = $name_gen.'.'.$img_ext;
    //บันทึกภาพ
    $upload_location = 'image/Product/';
    $full_path = $upload_location.$img_name;


    // $data = array();
    // $data["department_name"] = $request -> department_name;
    // $data["department_image"] = $request -> department_image;
    // $data["user_id"] = Auth::user() -> id;

    //Quary Builder
    #DB::table('departments') -> insert($data);
    #DB::table('departments') -> insert($data)
    Product::insert([
        'product_name' => $request -> product_name,
        'product_image' => $full_path,
        'user_id' => Auth::user() -> id,
        'product_price' => $request -> product_price,
    ]);
    $product_image -> move($upload_location,$img_name);
    return redirect() -> back() -> with('success', "บันทึกข้อมูลเรียบร้อย");
    }

    public function edit($id){
        $product = Product::find($id);
        return view('admin.product.edit',compact('product'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'product_name' => 'required|unique:Products|max:255'
        ],
        [   'product_name.required' => "กรุณป้อนชื่อเเผนกด้วยครับ",
            'product_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
            'product_name.unique' => "มีข้อมูลชื่อเเผนกอยู่ในฐานข้อมูลอยู่เเล้ว"]
    );
    $update = Product::find($id) -> update([
        'product_name' => $request -> product_name,
        'product_price' => $request -> product_price,
        'user_id' => Auth::user() -> id
    ]);

    return redirect() -> route('products') -> with('success', "อัพเดดข้อมูลเรียบร้อย");
    }

    public function softdelete($id){
        $delete = Product::find($id) -> forceDelete();
        return redirect() -> back() -> with('success', "ลบข้อมูลเรียบร้อย");
    }
}
