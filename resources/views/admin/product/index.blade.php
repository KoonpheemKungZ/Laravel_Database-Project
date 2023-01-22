<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี , {{Auth::user()->name}}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session("success"))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">ตารางข้อมูลเเผนก</div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">รูปภาพ</th>
                                <th scope="col">ชื่อสินค้า</th>
                                <th scope="col">ราคา</th>>
                                <th scope="col">ผู้ดูเเล</th>>
                                <th scope="col">เเก้ไข</th>>
                                <th scope="col">ลบข้อมูล</th>>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $row)
                                <tr>
                                    <th>{{$products -> firstItem() + $loop -> index}}</th>
                                    <td>
                                        <img src="{{asset($row ->product_image)}}" width="50px" height="50px" alt="">
                                    </td>
                                    <td>{{$row -> product_name}}</td>
                                    <td>{{$row -> product_price}}</td>
                                    <td>{{$row -> user -> name}}</td>
                                    <td>    
                                        <a href="{{url('/product/edit/'.$row -> id)}}" class="btn btn-primary">เเก้ไข</a>
                                    </td>
                                    <td>
                                        <a href="{{url('/product/softdelete/'.$row -> id)}}" class="btn btn-danger">ลบข้อมูล</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$products -> links()}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">เเบบฟอร์มเพิ่มสินค้า</div>
                            <div class="card-body">
                                <form action="{{route('addproduct')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="product_name" >ชื่อสินค้า</label>
                                        <input type="text" class="form-control" name="product_name" >
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name" >ราคา</label>
                                        <input type="text" class="form-control" name="product_price" >
                                    </div>
                                    @error('product_name')
                                        <div class="my-2">
                                        <span class="text-danger my-2">{{$message}}</span>
                                        </div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="product_image" >ภาพประกอบ</label>
                                        <input type="file" class="form-control" name="product_image" >
                                        
                                    </div>
                                    @error('product_name')
                                        <div class="my-2">
                                        <span class="text-danger my-2">{{$message}}</span>
                                        </div>
                                    @enderror
                                    <br>
                                    <input type="submit" value="บันทึก" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
