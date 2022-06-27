@extends('layouts.app');
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    


{!! Form::open(['route' => 'phone.store','method'=>'post']) !!}
<div class="py-3">
    <label for="exampleInputEmail1">phone</label>
    <input type="text" name="phone" class="form-control py-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone">

  </div>
  
  <button type="add" class="btn btn-primary">Submit</button>




{!! Form::close() !!}





@endsection