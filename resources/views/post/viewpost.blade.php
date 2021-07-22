@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

            <a href="{{route('add.category')}}" class="btn btn-danger">Add Category</a>
            <a href="{{route('all.category')}}" class="btn btn-info">All Category</a>
        
        <hr>

       <div>
            
            <img src="{{URL::to($post->image)}}" height="340px">
            <hr>
            <h3>{{$post->title}}</h3>
            <hr>

            <h6>Category Name: {{$post->name}}</h6>
            <p>{{$post->details}}</p>
       </div>

      </div>
    </div>
    </div>    
@endsection 