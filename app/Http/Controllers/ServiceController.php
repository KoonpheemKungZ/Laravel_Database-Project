<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
//use App\Models\CreateDB;
//$database = new CreateDB("basic", "departments");

class ServiceController extends Controller
{
    public function index(){
        $services = Product::all();
        return view('admin.service.index',compact('services'));
    }
    public function store(Request $request){
        $request->validate([
            'service_name' => 'required|unique:services|max:255',
            'service_image' => 'required|mimes:ipg,jpeg,png'
        ],
        [   'service_name.required' => "กรุณป้อนชื่อเเผนกด้วยครับ",
            'service_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
            'service_name.unique' => "มีข้อมูลชื่อเเผนกอยู่ในฐานข้อมูลอยู่เเล้ว",
            'service_image.required' => "กรุณาใส่รูปภาพด้วยครับ"]
    );
    }
}