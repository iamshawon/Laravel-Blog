@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

            <a href="{{route('add.category')}}" class="btn btn-success">Add New Category</a>
            <a href="{{route('all.category')}}" class="btn btn-info">All Category</a>
        
        <hr>

       <div>
       <h3>Category Details</h3><hr>
        <ol>
        <li>Category Name: {{$category->name}}</li><hr>
        <li>Category Slug: {{$category->slug}}</li><hr>
        <li>Created At: {{$category->created_at}}</li>
        </ol>
       </div>

      </div>
    </div>
    </div>    
@endsection 