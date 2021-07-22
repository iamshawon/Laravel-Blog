@extends('welcome')

@section('content')
<div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      @foreach($post as $row)
        <div class="post-preview">
          <a href="{{URL::to('view/post/' . $row->id)}}">
            
            <img src="{{URL::to($row->image)}}" style="height:400px;">
            <h2 class="post-title"><br>
              <a href="{{URL::to('view/post/' . $row->id)}}">{{$row->title}}</a>
            </h2>
          </a>
          <p class="post-meta">Category
            <a href="{{URL::to('view/post/' . $row->id)}}">{{$row->name}}</a>
            Slug on {{$row->slug}}</p>
        </div>
        <hr>
        @endforeach

        {{$post->links()}}

        
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
        
      </div>
    </div>
@endsection        