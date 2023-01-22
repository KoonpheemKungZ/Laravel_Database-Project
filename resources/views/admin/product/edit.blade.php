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
                <div class="card">
                        <div class="card-header">เเบบฟอร์มเเก้ไขข้อมูล</div>
                            <div class="card-body">
                                <form action="{{url('/product/update/'.$product -> id)}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="product_name">ชื่อสินค้า</label>
                                        <input type="text" class="form-control" name="product_name" value="{{$product -> product_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">ราคาสินค้า</label>
                                        <input type="text" class="form-control" name="product_price" value="{{$product -> product_price}}">
                                    </div>
                                    @error('product_name')
                                        <div class="my-2">
                                        <span class="text-danger my-2">{{$message}}</span>
                                        </div>
                                    @enderror
                                    <br>
                                    <input type="submit" value="อัพเดด" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
