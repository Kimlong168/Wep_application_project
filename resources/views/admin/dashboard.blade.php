@extends('admin.dashboardLayout')

@section('content')

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <a href="{{route('product.index')}}" class="text-decoration-none">
                <div class="card bg-success">
                    <div class="card-body text-light">
                        <h3 class="pb-4 fw-bold">Product</h3>
                        <p>Total: {{$count1}} 
                            @if($count1==1)
                                Product
                            @else
                                Products
                            @endif
                        </p>
                    </div>
                </div>
            </a>
        </div>
       
        <div class="col">
          <a href="{{route('category.index')}}"  class="text-decoration-none">
            <div class="card bg-danger">
                <div class="card-body text-light">
                    <h3 class="pb-4 fw-bold">Category</h3>
                    <p>Total: {{$count2}}
                         @if($count2==1)
                            Category
                        @else
                            Categories
                        @endif
                    </p>
                 </div>
            </div>
          </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col d-flex justify-content-center pizza-img">
            <img src="/assets/pizza-image.png" alt="" class="rounded img-fluid" width="100%">
        </div>
    </div>
</div>
@endsection