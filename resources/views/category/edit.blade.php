
@extends ('admin.dashboardLayout')

@section('content')
<div class="container">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Category</h1>
            
            <div class="card mb-4">
                <div class="card-body">
                @if(Session::has('category_update'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Primary!</strong> {!! session('category_update') !!}
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
                {!! Form::model($category , array('route' => array('category.update', $category->id), 'method'=>'PUT')) !!}
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name',null, array('class'=>'form-control')) !!}
                <br>
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description',null, array('class'=>'form-control')) !!}
                <br>
                {!! Form::submit('Update', array('class'=>'btn btn-primary btn-sm')) !!}
                <a href="/category" class="btn btn-danger btn-sm">Back</a>
                {!! Form::close() !!}
                
                </div>
            </div>	
        </div>
    </main>
</div>
@endsection