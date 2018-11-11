@extends('layouts.basic')

@section('content')
    <!-- 회원정보 수정 폼 -->
    <div class="jumbotron">
            {!! Form::model($board, ['method' => 'PATCH', 'action' => ['BoardController@update', 'id'=>$board->id]]) !!}
            <h1>회원 수정</h1>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control" name="user_pw" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" name="user_name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">E_Mail</label>
                <input type="text" class="form-control" name="email" placeholder="E_MAIL">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Address</label>
                <input type="text" class="form-control" name="addr" placeholder="Address">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
            {{ Form::close() }}
        </div>
@endsection