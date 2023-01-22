<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี , {{Auth::user()->name}}

        </h2>
    </x-slot>
     <!-- Slide Show -->
     <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://cdn.discordapp.com/attachments/956822517228642324/957575577181757470/01.png"  class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://cdn.discordapp.com/attachments/956822517228642324/957575577462788146/02.jpg"  class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://cdn.discordapp.com/attachments/956822517228642324/957575577722818590/03.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    
            <div class="row">
            @foreach($services as $row)
            <div class="col-md-3 col-sm-6 my-3 my-md-0">
                    <div class="card shadow">
                        <div class="rounded mx-auto d-block">
                            <img src="{{asset($row -> product_image)}}" width="300px" height="300px" alt="">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$row -> product_name}}</h5>
                            <h6>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            <h5>
                                <span class="price">{{$row -> product_price}} ฿</span>
                            </h5>
                            <a href="{{url('/cart/add/'.$row -> id)}}" class="btn btn-primary">เพิ่มลงตะกร้า</a>
                            
                        </div>
                    </div>
            </div>
            @endforeach

            </div>

</x-app-layout>
