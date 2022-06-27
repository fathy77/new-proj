@extends('layouts.app');
@section('content')
<a href="{{route('phone.create')}}"><button type="add" class="btn  btn-dark  my-3" style="margin-left: 100px">add another number</button></a>

<div class="container">

  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>name</th>
        <th>number</th>

      </tr>
    </thead>
    <tbody>
       
      @foreach ($phone as $ph)
      <tr class="info">
        <td>  {{$ph->user_id}}</td>
        <td>  {{$ph->User->name}}</td>
        <td>{{$ph->phone}}</td>
        @can('update', $ph)
        <td><a href="{{route("phone.edit",$ph->id)}}" class="card-link"> <button type="add" class="btn btn-Info btn-lg">ubdate</button></a></td>

        @endcan

<td>   {{ Form::open(['route'=>  array('phone.destroy',$ph->id ),'method'=>'delete'])  }} 
  @can('delete', $ph)
  <button type="add" class="btn btn-danger btn-lg">delete</button>
{{ Form::close() }}  </td>
@endcan
      </tr>
      @endforeach
     
    </tbody>
  </table>
</div>













@endsection