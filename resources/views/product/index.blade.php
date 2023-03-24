
@extends('admin.dashboardLayout')

@section('content')
<main>
   
    <div class="container mb-3">

        <div class="input-group mt-3 gap-3">
            {{ Form::open(array('url'=>'/filterByCategory','method'=>'get')) }}
            <div class="input-group">
                {{ Form::select('category_id', $categories, ['class' => 'form-control']) }}
                {{ Form::submit('Filter',array('class'=>'btn btn-primary')) }}
            </div>
            {{ Form::close() }}

            {{ Form::open(array('url'=>'/sortProduct','method'=>'get')) }}
            <div class="input-group">
                {{ Form::select('sortItem',['name'=>'Name','price'=>'Price','category_id'=>'Category'], ['class' => 'form-control']) }}
                {{ Form::submit('Sort',array('class'=>'btn btn-primary')) }}
            </div>
            {{ Form::close() }}
        </div>

	    <!-- <a class="btn btn-primary btn-sm my-3" href="/product/create">Create</a> -->
		<div class="card border border-success p-3 pb-0 mt-3">
			
			@if(Session::has('product_delete'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Primary!</strong> {!! session('product_delete') !!}
                </div>
            @endif

            {{ Form::open(array('url'=>'/search','method'=>'get')) }}
            <div class="input-group">
                {{ Form::text('keyword',$keyword ?? '', array('placeholder'=>'Search', 'class'=>'form-control')) }}
                {{ Form::submit('search',array('class'=>'btn btn-primary')) }}
            </div>
            {{ Form::close() }}

			<div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h3>Product</h3>
                    <a href="/product/create"><i class="fa-solid fa-circle-plus h5"></i></a>
                </div>
				<table class="table mt-3">
                    <thead class="table-success text-success">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
					<tbody>
                        @if(sizeof($products)==0)
                        <td colspan="7" class="text-center text-danger h3 py-4">Search Not Found!</td>
                        @endif
                        @foreach($products as $product)
                            <tr>
                                <td>{{++$num}}</td>
                                <td><a href="{{url('/product/'.$product->id)}}">{{$product->name}}</a></td>

                                @if(isset($product->category->name))
                                <td>{{$product->category->name}}</td>
                                @else
                                <td class="text-danger">Null</td>
                                @endif
                                
                                <td>{{$product->price}}</td>
                                <td>
                                    <div>{{ Html::image('/assets/'.$product->image, $product->name, array('width'=>'60')) }}</div>
                                </td>
                                <td><a class="btn btn-primary btn-sm" href="{{url('/product/'.$product->id).'/edit'}}">Update</a></td>
                                <td>
                                {!! Form::open(array('url'=>'product/'. $product->id, 'method'=>'DELETE')) !!}
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                    <button class="btn btn-danger btn-sm delete">Delete</button>
                                {!! Form::close() !!} 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="border-0"> <a href="/dashboard"><button type="button" class="btn btn-outline-primary btn-sm ">Back</button></a></td>
                        </tr>
                    </tfoot>
				</table>
			</div>
		</div>
		
	</div>
</main>
@endsection
