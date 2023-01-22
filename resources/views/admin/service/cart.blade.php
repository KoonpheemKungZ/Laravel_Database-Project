@php
    $total = 0;
    $count = 0;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี ,{{Auth::user()-> name}}

        </h2>
    </x-slot>
    <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                         <form action="{{url('addCart')}}" method="post" class="cart-items" enctype="multipart/form-data">
                            <div class="border rounded">
                                <div class="row bg-white">
                                @foreach($cart as $row)
                                @if(Auth::user() -> name == $row -> cart_user)
                                        <div class="col-md-3 pl-0">
                                            <img src={{asset($row ->cart_image)}} alt="" class="img-fluid">
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="pt-4">{{$row -> cart_name}}</h5>
                                            <h5 class="pt-4">{{$row -> cart_price}} ฿</h5>

                                            <a href="{{url('/cart/softdelete/'.$row -> id)}}" class="btn btn-danger">ลบข้อมูล</a>
                                        </div>
                                        <div class="col-md-3 py-5">
                                            
                                        </div>
                                @endif
                                @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                        <h6>PRICE DETAILS</h6>
                        <hr>
                        <div class="row price-details">
                            <div class="col-md-6">
                            <span class="visually-hidden">
                                @foreach($cart as $row)
                                @if(Auth::user() -> name == $row -> cart_user)
                                        {{$count =  $count + 1 }}
                                @endif
                                @endforeach
                            </span>
                                <h6>Price ({{$count}} items)</h6>
                                <h6>Delivery Charges</h6>
                                <hr>
                                <h6>Amount Payable</h6>
                            </div>
                            <div class="col-md-6">
                            <span class="visually-hidden">
                                @foreach($cart as $row)
                                @if(Auth::user() -> name == $row -> cart_user)
                                    {{$total = $row -> cart_price+ $total }}
                                @endif
                                @endforeach
                                </span>
                                
                                <h6>{{$total}} ฿</h6>
                                <h6 class="text-success">FREE</h6>
                                <hr>
                                <h6><?php
                                    ;
                                    ?>{{$total}} ฿</h6>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
        
</x-app-layout>