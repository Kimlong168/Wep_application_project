
@extends ('admin.dashboardLayout')

@section('content')
<div class="container">
    <main>
        <div class="container">
            <div class="card p-4 m-4 border border-success">
                <h3 class="mb-3">Category</h3>
            
                <p>ID: {{$category->id}}</p>
                <p>Name: {{$category->name}}</p>
                <p>Description: {{$category->description}}</p>
                <div class="d-flex gap-2">
                    <a href="{{url('/category/'.$category->id.'/edit')}}">
                        <button class="btn btn-outline-primary btn-sm">Update</button>
                    </a>
                    <a class="text-decoration-none text-light" href="/category">
                        <button class="btn btn-outline-danger btn-sm">Back</button>
                    </a>
                </div>
                
            </div>
            
        </div>
    </main>
</div>
@endsection