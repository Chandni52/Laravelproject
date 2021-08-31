@extends('layout')


@section('content')
<h1>Login Here:</h1>
<form method="post" action="login">
    @csrf
    <div class="form-group">
       
        <input type="text" name="email" class="form-control" placeholder="Enter email">
       </div>
       <br>
     <div class="form-group">
        
        <input type="password" name="password" class="form-control" placeholder="Enter password">
       </div>
   
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
@stop