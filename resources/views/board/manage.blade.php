@extends('layouts.master')

@section('content')
    <div class="col-lg-9">
        <br><br><br><br><br><br><br><br>
        <h1><b>모든 회원정보 보기</b></h1>
        <br><hr><br>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>user_email</th>
                    <th>user_name</th>
                    <th>address</th>
                </tr>
            </thead>
            @foreach($users as $user)
            <tbody>
                <tr> 
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->addr}}</td>
                </tr>   
                </tbody>
            @endforeach        
        </table>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
@endSection