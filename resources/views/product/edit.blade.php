@extends('admin.dashboardLayout')
@section('content')
<div class="container">
<main>
	<div class="container-fluid">
		<h3 class="mt-4">Edit Category</h3>

		<div class="card mb-4">
			<div class="card-body">
            @if(Session::has('product_update'))
            <div class="alert alert-primary alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Primary!</strong> {!! session('product_update') !!}
            </div>
            @endif
            @if (count($errors) > 0)
            <!-- Form Error List -->
            <div class="alert alert-danger">
                <strong>Something is Wrong</strong>
                <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                {!! Form::model($product , array('route' => array('product.update', $product->id), 'method'=>'PUT','files'=>'true')) !!}
                {!! Form::label('category_id', 'Category:') !!}
                {!! Form::select('category_id',$categories,null, array('class'=>'form-control')) !!}
                <br>
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name',null, array('class'=>'form-control')) !!}
                <br>
                {!! Form::label('price', 'Price:') !!}
                {!! Form::text('price',null, array('class'=>'form-control')) !!}
                <br>
                {!! Form::label('image', 'Image:') !!}
                {!! Form::file('image', array('class'=>'form-control')) !!}
                <br>
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description',null, array('class'=>'form-control')) !!}
                <br>
                {!! Form::submit('Update', array('class'=>'btn btn-primary btn-sm')) !!}
                <a class="btn btn-danger btn-sm" href="{!! url('/product')!!}">Back</a>
                {!! Form::close() !!}
			</div>
		</div>	
	</div>
</main>
</div>
@endsection