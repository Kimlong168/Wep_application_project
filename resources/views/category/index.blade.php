
@extends('admin.dashboardLayout')

@section('content')

<div class="container mb-3">
    
    <div class="card card border border-success p-3 pb-0 mt-3">
        @if(Session::has('product_delete'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Primary!</strong> {!! session('product_delete') !!}
                </div>
        @endif

        {{ Form::open(array('url'=>'/searchCategory','method'=>'get')) }}
            <div class="input-group">
                {{ Form::text('keyword',$keyword ?? '', array('placeholder'=>'Search', 'class'=>'form-control')) }}
                {{ Form::submit('search',array('class'=>'btn btn-primary')) }}
            </div>
        {{ Form::close() }}
        
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h3>Category</h3>
                <a href="/category/create"><i class="fa-solid fa-circle-plus h5"></i></a>
            </div>
            
            <table class="table mt-3">
            <thead class="table-success text-success">
                <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @if(sizeof($categories)==0)
                    <td colspan="7" class="text-center text-danger h3 py-4">Search Not Found!</td>
                @endif
                @foreach($categories as $category)
                    <tr>
                        <td>{{++$num}}</td>
                        <td><a href="{{route('category.show', $category->id )}}">{{$category->name}}</a></td>
                        <td><a href="{{route('category.edit', $category->id )}}"><button class="btn btn-sm btn-primary" >Update</button></a></td>
                        <td>
                            {!! Form::open(array('url'=>'category/'. $category->id, 'method'=>'DELETE')) !!}
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                                <button class="btn btn-sm btn-danger">Delete</button>
                            {!! Form::close() !!} 
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="border-0"> <a href="/dashboard"><button type="button" class="btn btn-outline-primary btn-sm">Back</button></a></td>
                </tr>
            </tfoot>
            </table>
        </div>
    </div>
        
    <!-- confirm delete -->
    <div class="modal fade" class="confirm-delete" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold text-success" id="exampleModalLabel">Delete Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger text-center h4 fw-bold">Are you sure to delete?</p>
                    <p class="debug-url"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="" class="btn btn-danger btn-ok">Yes</a>
                
                </div>
            </div>
        </div>
    </div>
    
</div>

<script src="{{asset('js/edit.js')}}" ></script>
@endsection