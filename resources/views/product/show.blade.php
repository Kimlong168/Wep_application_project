@extends('admin.dashboardLayout')

@section('content')
<main>
    <div class="container">
        <div class="card p-4 m-4 border border-success">
            <div class="row">
                <div class="col">
                    <h3 class="mb-3">Product</h3>
                    
                    <p>Name: {{$product->name}}</p>
                    
                    @if(isset($product->category->name))
                    <p>Categoty: {{$product->category->name}}</p>
                    @else
                    <p>Category: <span class="text-danger">Null</span></p>
                    @endif

                    <p>Price: {{$product->price}} ៛</p>
                 
                    <p>Description: {{$product->description}}</p>
                    <div class="d-flex gap-2">
                            <a href="{{url('/product/'.$product->id.'/edit')}}">
                                <button class="btn btn-outline-primary btn-sm">Update</button>
                            </a>
                            <a class="text-decoration-none text-light" href="/product">
                                <button class="btn btn-outline-danger btn-sm">Back</button>
                            </a>
                    </div>
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <div>{{ Html::image('/assets/'.$product->image, $product->name, array('style="max-width:300px"')) }}</div>
                </div>
            </div>
         
        </div>
        
    </div>
</main>
@endsection