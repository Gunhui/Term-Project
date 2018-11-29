@extends('layouts.master')

@section('style')
  <style>
    .row{
      height:1200px;
    }
  </style>
@endSection

@section('content')
<div class="col-lg-9">
        @if(Auth::check())
            @if($master == 1)
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
            @else
                <br><br><br>
                <h1><b>내가 올린 봉사 모집글</b></h1>
                <br><br>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>content_title</th>
                                <th>content_loc</th>
                                <th>execute_date</th>
                                <th>hits</th>
                            </tr>
                        </thead>
                    @foreach($contents as $content)
                        <tbody>
                        <tr>
                            <td>{{ $content->content_title }}</td>
                            <td>{{ $content->content_loc }}</td>
                            <td>{{ $content->execute_date }}</td>
                            <td>{{ $content->hits }}</td>
                        </tr>   
                        </tbody>
                    @endforeach      
                    </table>
                    <br><br><hr><br><br>
                    <h1><b>내가 쓴 공지글 목록</b></h1>
                    <br><br>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>content_title</th>
                                <th>regtime</th>
                                <th>hits</th>
        
                            </tr>
                        </thead>
                    @if($notices != [])
                        @foreach($notices as $notice)
                            <tbody>
                            <tr>
                                <td>{{ $notice->content_title }}</td>
                                <td>{{ $notice->created_at }}</td>
                                <td>{{ $notice->hits }}</td>
                            </tr>   
                            </tbody>   
                        @endforeach
                    @endif
                    </table>

                    <br><br><hr><br>
                    <h1><b>내가 신청한 봉사 목록</b></h1>
                    <br><br>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>content_title</th>
                                <th>content_loc</th>
                                <th>writer</th>
                                <th>hits</th>
        
                            </tr>
                        </thead>
                    @foreach($lists as $list)
                        <tbody>
                        <tr>
                            <td>{{ $list[0]->content_title }}</td>
                            <td>{{ $list[0]->content_loc }}</td>
                            <td>{{ $list[0]->writer }}</td>
                            <td>{{ $list[0]->hits }}</td>
                        </tr>   
                        </tbody>   
                    @endforeach
                    </table>
                    @endif
                @endif
@endSection