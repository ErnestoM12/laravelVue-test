@extends('layouts.app')

@section('content')
<div class="container">
 <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Fecha</th>
      <th scope="col">Dollar</th>
      <th scope="col">Euro</th>
    </tr>
  </thead>
  <tbody>	
    <tr>
      <td>{{date('Y-m-d h:i:s', strtotime($dollar['fecha']))}}</td>
      <td>{{$dollar['dolar']['valor']}}</td>
      <td>{{$dollar['euro']['valor']}}</td>

    </tr>
  </tbody>
</table>

<h1> listado de post</h1>
<div class="row">
@foreach($posts as $post)	
 <div class="col-3">
  <div class="card">
  <div class="card-header bg-dark text-white text-center">
  	Post
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$post['title']}}</h5>
    <p class="card-text">{{$post['body']}}</p>
    <a href="#" class="btn btn-primary"> continue</a>
  </div>
   </div>
  </div>
 @endforeach
 </div>
</div>
</div>
@endsection
