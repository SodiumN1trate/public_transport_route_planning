@extends('layout')

@section('main_content')
        <form class="login-box" method="post" action="admin/login">
            @csrf
            <h1>Admin page</h1>
            <input type="text" name="username">
            <input type="password" name="password">
            <button type="submit">Ieiet</button>
        </form>
@endsection()
