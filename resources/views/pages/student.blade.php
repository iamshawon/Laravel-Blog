@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

    <a href="{{route('all.student')}}" class="btn btn-info">All Student</a>

       <div>
            
            <hr>
            <h3>{{$student->name}}</h3>
            <hr>

            <h6>Student Email: {{$student->email}}</h6><hr>
            <h6>Student Phone: {{$student->phone}}</h6>
       </div>

      </div>
    </div>
    </div>    
@endsection 